<?php

namespace Family\Forum;

class PostCommentCommand
{
    public $body;
    public $author;
    public $groupId;
    public $threadId;
    public $categoryId;

    public function __construct($body, $author, $groupId, $threadId, $categoryId)
    {
        $this->body = $body;
        $this->author = $author;
        $this->groupId = $groupId;
        $this->threadId = $threadId;
        $this->categoryId = $categoryId;
    }
}