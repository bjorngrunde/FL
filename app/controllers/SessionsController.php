<?php

use Family\Forms\LoginForm;

class SessionsController extends BaseController
{
    /**
     * @var LoginForm
     */
    private $loginForm;

    /**
     * @param LoginForm $loginForm
     */
    function __construct(LoginForm $loginForm)
    {
        $this->loginForm = $loginForm;
    }

    /**
     * @return mixed
     */

    public function create()
    {

        return View::make('sessions.create');
    }

    public function store()
    {
        $this->loginForm->validate($input = Input::only('email', 'password'));

        if(Auth::attempt($input, true))
        {
            if(Auth::user()->hasRole('Bannad'))
            {
                Auth::logout();
                return Redirect::to('/')->withFlashMessage('Du kan inte logga in. Du har blivit bannad.');
            }
            return Redirect::intended('/dashboard');
        }

        return Redirect::back()->withInput()->withFlashMessage('Dina inloggninsuppgifter stämde inte.');
    }

    public function destroy($id = null)
    {
        Auth::logout();

        return Redirect::to('/')->with('flash_message', 'Du har blivit utloggad!');
    }
}