<?php

use Family\Registration\PostRegistrationCommand;
class RegistrationController extends BaseController
{

    public function store()
    {
        $input = Input::only('username', 'email', 'name', 'lastName', 'rank', 'klass', 'server', 'role');
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