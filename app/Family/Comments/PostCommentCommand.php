<?php

namespace Family\Comments;
class PostCommentCommand
{
    public $commentable_type;
    public $commentable_id;
    public $comment;
    public $user_id;

    public function __construct($commentable_type, $commentable_id, $comment, $user_id)
    {
        $this->commentable_type = $commentable_type;
        $this->commentable_id = $commentable_id;
        $this->comment = $comment;
        $this->user_id = $user_id;
    }
}