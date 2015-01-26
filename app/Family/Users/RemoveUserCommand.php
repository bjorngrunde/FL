<?php

namespace Family\Users;


class RemoveUserCommand
{
    public $username;

    function __construct($username)
    {
        $this->username = $username;
    }
} 