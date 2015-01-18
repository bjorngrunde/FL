<?php

namespace Family\Registration;

use Family\Forms\RegistrationAutoForm;
class PostRegistrationValidator
{
    private $autoForm;

    function __construct(RegistrationAutoForm $autoForm)
    {
        $this->autoForm = $autoForm;
    }

    public function validate(PostRegistrationCommand $command)
    {

        $this->autoForm->validate($command);
    }
} 