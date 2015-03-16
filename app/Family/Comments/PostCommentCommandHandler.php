<?php

namespace Family\Comments;

use Family\Commanding\CommandHandler;
use Family\Eventing\EventDispatcher;
use Comment;

class PostCommentCommandHandler implements CommandHandler
{
    public $comment;
    public $dispatcher;

    public function __construct(Comment $comment, EventDispatcher $dispatcher)
    {
        $this->comment = $comment;
        $this->dispatcher = $dispatcher;
    }

    public function handle($command)
    {
        $comment = $this->comment->post(
            $command->commentable_type,
            $command->commentable_id,
            $command->comment,
            $command->user_id
        );
        $this->dispatcher->dispatch($comment->releaseEvents());
    }
} 