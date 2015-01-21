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
        $user = $this->user->edit(
            $this->$username,
            $this->$name,
            $this->$lastName,
            $this->$klass,
            $this->$rank,
            $this->$phone,
            $this->$password,
            $this->$password_confirmation,
            $this->$email,
            $this->$role
        );
        $this->dispatcher->dispatch($user->releaseEvents());
    }
}