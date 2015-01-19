<?php

namespace Family\Registration;

use User;
class RegistrationWasPosted {

    public $user;
    public $password;

    function __construct(User $user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }
} 