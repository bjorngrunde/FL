<?php

namespace Family\Registration;
class PostRegistrationCommand
{
    public $username;
    public $name;
    public $lastName;
    public $email;
    public $rank;
    public $klass;
    public $server;
    public $role;

    function __construct($username, $name, $lastName, $email, $rank, $klass, $server, $role)
    {
        $this->username = $username;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->rank = $rank;
        $this->klass = $klass;
        $this->server = $server;
        $this->role = $role;

    }
} 