<?php

use Family\Forms\ProfileData;
use Family\Forms\UserEmail;
use Family\Forms\UserPassword;
use Illuminate\Routing\Controller;

class UsersController extends Controller
{
    /**
     * @var userPassword
     */
    private $userPassword;
    /**
     * @var ProfileData
     */
    private $profileData;
    /**
     * @var UserEmail
     */
    private $userEmail;

    /**
     * @param userPassword $userPassword
     * @param UserEmail $userEmail
     * @param ProfileData $profileData
     */
    public function __construct(UserPassword $userPassword,UserEmail $userEmail ,ProfileData $profileData)
    {

        $this->userPassword = $userPassword;
        $this->profileData = $profileData;
        $this->userEmail = $userEmail;
    }
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(25);
        return View::make('users.index', compact('users'));
    }

    public function edit($username)
    {
        $user = User::with('profile')->whereUsername($username)->firstOrFail();

        return View::make('users.edit', ['user' => $user]);
    }

    public function update($username)
    {
        $checkPassword = Input::get('password');
        $checkEmail = Input::get('email');
        $checkRole = Input::get('role');
        if(!empty($checkPassword))
        {
            $user = User::whereUsername($username)->firstOrFail();

            $input = Input::only('password', 'password_confirmation');

            $this->userPassword->validate($input);

            $user->password = Input::get('password');
            $user->save();

            return Redirect::back()->withFlashMessage('Lösenord har uppdaterats');
        }
        elseif(!empty($checkEmail))
        {
            $user = User::whereUsername($username)->firstOrFail();

            $input = Input::only('email');

            $this->userEmail->validate($input);

            $user->email = Input::get('email');
            $user->save();

            return Redirect::back()->withFlashMessage('Email har uppdaterats');
        }
        elseif(!empty($checkRole))
        {
            $user = User::with('roles')->whereUsername($username)->firstOrFail();

            $user->roles()->detach();

            $role = Role::whereId(Input::get('role'))->firstOrFail();

            $user->roles()->attach($role->id);

            return Redirect::back()->withFlashMessage('Användarens roll har uppdaterats till '. $role->name);
        }
        else
        {
            $user = User::with('profile')->whereUsername($username)->firstOrFail();

            $input = Input::only('name', 'lastName', 'klass', 'rank', 'phone');

            $this->profileData->validate($input);

            $user->profile->name = Input::get('name');
            $user->profile->lastName = Input::get('lastName');
            $user->profile->klass = Input::get('klass');
            $user->profile->rank = Input::get('rank');
            $user->profile->phone = Input::get('phone');
            $user->profile->save();

            return Redirect::back()->withFlashMessage('Profil har uppdaterats');
        }
    }
    public function destroy($username)
    {
        $user = User::with('profile')->whereUsername($username)->firstOrFail();

        $user->profile->delete();

        $user->delete();

        return Redirect::back()->withFlashMessage('Användaren har tagits bort');
    }
}