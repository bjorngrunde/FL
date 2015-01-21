<?php

namespace Family\Users;


use Family\Forms\ProfileForm;
use Family\Forms\UserEmail;
use Family\Forms\UserPassword;

class UpdateUserValidator
{

    private $profileForm;

    private $userEmail;

    private $password;

    function  __construct(ProfileForm $profileForm, UserEmail $userEmail, UserPassword $userPassword)
    {

        $this->profileForm = $profileForm;
        $this->userEmail = $userEmail;
        $this->password = $userPassword;
    }

    public function validate($command)
    {
        $checkEmail = $command->email;
        $checkPassword = $command->password;

        if(!empty($checkPassword))
        {
            $this->password->validate($command);
        }
        elseif(!empty($checkEmail))
        {
            $this->userEmail->validate($command);
        }
        else
        {
            $this->profileForm->validate($command);
        }
    }
} 