<?php

namespace Family\Users;


use Family\Commanding\CommandHandler;
use Family\Eventing\EventDispatcher;
use User;
class UpdateUserCommandHandler implements CommandHandler {

    private $user;
    private $dispatcher;

    function __construct(User $user, EventDispatcher $dispatcher)
    {
        $this->user = $user;
        $this->dispatcher = $dispatcher;
    }
    public function handle($command)
    {
        if(!empty($command->password))
        {
            $user = $this->user->editPassword(
                $command->username,
                $command->password
            );
            $this->dispatcher->dispatch($user->releaseEvents());
        }
        elseif(!empty($command->email))
        {
            $user = $this->user->editEmail(
                $command->username,
                $command->email
            );
            $this->dispatcher->dispatch($user->releaseEvents());
        }
        elseif(!empty($command->role))
        {
            $user = $this->user->editRole(
                $command->username,
                $command->role
            );
            $this->dispatcher->dispatch($user->releaseEvents());
        }
        else
        {
            $user = $this->user->edit(
                $command->username,
                $command->name,
                $command->lastName,
                $command->klass,
                $command->rank,
                $command->phone
            );
            $this->dispatcher->dispatch($user->releaseEvents());
        }
    }
}