<?php

use Family\Forms\ProfileForm;
use Family\Forms\UserEmail;
use Family\Forms\UserPassword;
use Family\Users\RemoveUserCommand;
use Family\Users\UpdateUserCommand;

class UsersController extends BaseController
{

    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(15);
        return View::make('users.index', compact('users'));
    }

    public function members()
    {
        $users = User::with('profile', 'server')->get();

        return View::make('users.members', ['users' => $users]);
    }

    public function show($id)
    {
        $user = User::with('profile', 'server', 'threads', 'comments','raids')->whereId($id)->firstOrFail();
        $raid = Raid::all();
        if($user == null)
        {
            return Redirect::back()->withFlashMessage('Något gick fel. Användaren existerar inte');
        }


        return View::make('users.show')->with('user', $user)->with('raids', $raid);
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

        if($rank == 'Guild Master')
        {
            if(Auth::user()->profile->rank != 'Guild Master' )
            {
                Return Redirect::back()->withFlashMessage('Du kan inte sno Guild Master Titeln');
            }
        }


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
        $command = new RemoveUserCommand($username);
        $this->CommandBus->execute($command);

        return Redirect::to('/admin/users/')->withFlashMessage('Användaren har tagits bort');
    }
}