<?php

namespace Family\Forum;

class UpdateThreadCommand
{
    public $title;
    public $body;

    function __construct($title, $body)
    {
        $this->title = $title;
        $this->body = $body;
    }
}