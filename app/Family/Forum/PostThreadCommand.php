<?php

namespace Family\Forum;

class PostThreadCommand
{
    public $title;
    public $body;
    public $category_id;
    public $author_id;
    public $group_id;

    function __construct($title, $body, $category_id, $author_id, $group_id)
    {
        $this->title = $title;
        $this->body = $body;
        $this->category_id = $category_id;
        $this->author_id = $author_id;
        $this->group_id = $group_id;
    }
}