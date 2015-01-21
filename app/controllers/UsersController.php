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
        return Redirect::back()->withFlashMessage('Profil har uppdaterats');

    }
    public function destroy($username)
    {
        $user = User::with('profile')->whereUsername($username)->firstOrFail();

        $user->profile->delete();

        $user->delete();

        return Redirect::back()->withFlashMessage('Användaren har tagits bort');
    }
}