<?php

namespace Family\Users;


class UpdateUserCommand
{
    public $username;
    public $name;
    public $lastName;
    public $klass;
    public $rank;
    public $phone;
    public $password;
    public $password_confirmation;
    public $email;
    public $role;

    function __construct($username, $name, $lastName, $klass, $rank, $phone, $password, $password_confirmation, $email, $role)
    {
        $this->username = $username;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->klass = $klass;
        $this->rank = $rank;
        $this->phone = $phone;
        $this->password = $password;
        $this->password_confirmation = $password_confirmation;
        $this->email = $email;
        $this->role = $role;

    }


} 