<?php

namespace Family\Forum;
use ForumComment;
class CommentWasPosted
{
    public $comment;

    public function __construct(ForumComment $comment)
    {
        $this->comment = $comment;
    }
}