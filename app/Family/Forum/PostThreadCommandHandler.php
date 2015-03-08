<?php

namespace Family\Forum;

use Family\Commanding\CommandHandler;
use Family\Eventing\EventDispatcher;
use ForumThread;

class PostThreadCommandHandler implements CommandHandler
{

    private $forumThread;

    private $dispatcher;

    public function __construct(ForumThread $forumThread, EventDispatcher $dispatcher)
    {
        $this->forumThread = $forumThread;
        $this->dispatcher = $dispatcher;
    }
    public function handle($command)
    {
        $forumThread = $this->forumThread->post(
            $command->title,
            $command->body,
            $command->category_id,
            $command->author_id,
            $command->group_id);

        $this->dispatcher->dispatch($forumThread->releaseEvents());
    }
}