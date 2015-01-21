<?php

use Family\Forms\ProfileForm;
use Family\Forms\UserEmail;
use Family\Forms\UserPassword;
use Family\Users\UpdateUserCommand;

class UsersController extends BaseController
{

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
        $name = Input::get('name');
        $lastName = Input::get('lastName');
        $klass = Input::get('klass');
        $rank = Input::get('rank');
        $phone = Input::get('phone');
        $password = Input::get('password');
        $password_confirmation = Input::get('password_confirmation');
        $email = Input::get('email');
        $role = Input::get('role');

        $command = new UpdateUserCommand(
            $username,
            $name,
            $lastName,
            $klass,
            $rank,
            $phone,
            $password,
            $password_confirmation,
            $email,
            $role

        );

        $this->CommandBus->execute($command);
        /*
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

            $this->profileForm->validate($input);

            $user->profile->name = Input::get('name');
            $user->profile->lastName = Input::get('lastName');
            $user->profile->klass = Input::get('klass');
            $user->profile->rank = Input::get('rank');
            $user->profile->phone = Input::get('phone');
            $user->profile->save();

            return Redirect::back()->withFlashMessage('Profil har uppdaterats');
        } */
    }
    public function destroy($username)
    {
        $user = User::with('profile')->whereUsername($username)->firstOrFail();

        $user->profile->delete();

        $user->delete();

        return Redirect::back()->withFlashMessage('Användaren har tagits bort');
    }
}