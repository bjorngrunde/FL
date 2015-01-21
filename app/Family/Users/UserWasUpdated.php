<?php

namespace Family\Users;

use User;
class UserWasUpdated
{
    public $user;
    public $username;

    function __construct(User $user, $username)
    {
        $this->user = $user;
        $this->username = $username;
    }
} 