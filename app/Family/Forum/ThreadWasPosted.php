<?php

namespace Family\Forum;
use ForumThread;
class ThreadWasPosted
{
    public $forumThread;

    function __construct(ForumThread $forumThread)
    {

        $this->forumThread = $forumThread;
    }
}