<?php

namespace Family\Comments;

use Comment;
class CommentWasPosted
{
    public $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
} 