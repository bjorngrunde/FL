<?php

namespace Family\Users;


use Family\Commanding\CommandHandler;
use Family\Eventing\EventDispatcher;
use User;

class RemoveUserCommandHandler implements CommandHandler {

    /**
     * @var User
     */
    private $user;
    /**
     * @var EventDispatcher
     */
    private $dispatcher;

    function __construct(User $user, EventDispatcher $dispatcher)
    {

        $this->user = $user;
        $this->dispatcher = $dispatcher;
    }
    public function handle($command)
    {
        $user = $this->user->remove($command->username);
        $this->dispatcher->dispatch($user->releaseEvents());
    }
}