<?php

namespace Family\Forum;

use Family\Commanding\CommandHandler;
use Family\Eventing\EventDispatcher;
use ForumComment;

class PostCommentCommandHandler implements CommandHandler
{
    public $comment;
    public $dispatcher;

    public function __construct(ForumComment $comment, EventDispatcher $dispatcher)
    {
        $this->comment = $comment;
        $this->dispatcher = $dispatcher;
    }
    public function handle($command)
    {
        $forumComment = $this->comment->post(
            $command->body,
            $command->author,
            $command->groupId,
            $command->threadId,
            $command->categoryId
        );
        $this->dispatcher->dispatch($forumComment->releaseEvents());
    }
}