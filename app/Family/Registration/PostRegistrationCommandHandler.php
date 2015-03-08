<?php

namespace Family\Registration;


use Family\Commanding\CommandHandler;
use Family\Eventing\EventDispatcher;
use User;
class PostRegistrationCommandHandler implements CommandHandler
{
    private $user;

    private $dispatcher;

    function __construct(User $user, EventDispatcher $dispatcher)
    {

        $this->user = $user;
        $this->dispatcher = $dispatcher;
    }

    public function handle($command)
    {
       $user = $this->user->post(
           $command->name,
           $command->lastName,
           $command->username,
           $command->email,
           $command->rank,
           $command->klass,
           $command->server,
           $command->role
       );
        $this->dispatcher->dispatch($user->releaseEvents());

    }
}