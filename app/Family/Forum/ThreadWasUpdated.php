<?php

namespace Family\Forum;
use ForumThread;
class ThreadWasUpdated
{
    public $forumThread;

    public function __construct(ForumThread $forumThread)
    {
        $this->forumThread = $forumThread;
    }
}