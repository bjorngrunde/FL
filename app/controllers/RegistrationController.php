<?php

use Family\Registration\PostRegistrationCommand;
class RegistrationController extends BaseController
{

    public function store()
    {
        $input = Input::only('username', 'email', 'name', 'lastName', 'rank', 'klass', 'server', 'role');

        if(Input::get('role') == 'Utvecklare')
        {
            if(!Auth::user()->hasRole('Utvecklare'))
            {
                return Redirect::back()->withFlashMessage('Du har inte behörighet att ange den rollen');
            }
        }

        if(User::whereUsername(Input::get('username'))->first())
        {
            return Redirect::back()->withFlashMessage('Denna användare har redan skapats!');
        }
        $command = new PostRegistrationCommand(
          $input['username'],
          $input['name'],
          $input['lastName'],
          $input['email'],
          $input['rank'],
          $input['klass'],
          $input['server'],
          $input['role']
        );
        $this->CommandBus->execute($command);

        return Redirect::back()->withFlashMessage('Användare skapades, email har skickats med användaruppgifter!');
    }

    public function create()
    {
        return View::make('registration.create');
    }

}