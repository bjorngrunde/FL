<?php

namespace Family\Forum;
use ForumComment;
class ForumCommentWasPosted
{
    public $comment;

    public function __construct(ForumComment $comment)
    {
        $this->comment = $comment;
    }
}