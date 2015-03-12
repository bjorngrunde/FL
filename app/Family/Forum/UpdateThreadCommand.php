<?php

namespace Family\Forum;

class UpdateThreadCommand
{
    public $title;
    public $body;
    public $id;

    function __construct($title, $body, $id)
    {
        $this->title = $title;
        $this->body = $body;
        $this->id = $id;
    }
}