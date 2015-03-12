<?php

namespace Family\Forum;

use Family\Commanding\CommandHandler;
use Family\Eventing\EventDispatcher;
use ForumThread;
class UpdateThreadCommandHandler implements CommandHandler
{

    public $forumThread;

    public $dispatcher;

    public function __construct(ForumThread $forumThread, EventDispatcher $dispatcher)
    {

        $this->forumThread = $forumThread;
        $this->dispatcher = $dispatcher;
    }

    public function handle($command)
    {
        $forumThread = $this->forumThread->edit(
            $command->title,
            $command->body,
            $command->id
        );
        $this->dispatcher->dispatch($forumThread->releaseEvents());
    }
}