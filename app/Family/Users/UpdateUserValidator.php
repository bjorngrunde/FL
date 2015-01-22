<?php

namespace Family\Users;


use Family\Forms\ProfileForm;
use Family\Forms\RoleForm;
use Family\Forms\UserEmail;
use Family\Forms\UserPassword;

class UpdateUserValidator
{

    private $profileForm;

    private $userEmail;

    private $password;
    /**
     * @var RoleForm
     */
    private $roleForm;

    function  __construct(ProfileForm $profileForm, UserEmail $userEmail, UserPassword $userPassword, RoleForm $roleForm)
    {

        $this->profileForm = $profileForm;
        $this->userEmail = $userEmail;
        $this->password = $userPassword;
        $this->roleForm = $roleForm;
    }

    public function validate($command)
    {
        $checkEmail = $command->email;
        $checkPassword = $command->password;
        $checkRole = $command->role;
        if(!empty($checkPassword))
        {
            $this->password->validate($command);
        }
        elseif(!empty($checkEmail))
        {
            $this->userEmail->validate($command);
        }
        elseif(!empty($checkRole))
        {
            $this->roleForm->validate($command);
        }
        else
        {
            $this->profileForm->validate($command);
        }
    }
} 