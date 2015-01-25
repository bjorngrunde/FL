<?php

namespace Family\Users;

use User;
class UserWasRemoved {

    public $user;

    function __construct(User $user)
    {
        $this->user = $user;
    }
} 