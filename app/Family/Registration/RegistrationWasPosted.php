<?php

namespace Family\Registration;

use User;
class RegistrationWasPosted {

    private $user;

    function __construct(User $user)
    {
        $this->user = $user;
    }
} 