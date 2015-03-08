<?php

namespace Family\Forum;

use Family\Forms\NewThreadForm;
use Family\Forum\UpdateThreadCommand;
class UpdateThreadValidator
{
    private $form;

    public function __construct(NewThreadForm $form)
    {
        $this->form = $form;
    }

    public function validate(UpdateThreadCommand $command)
    {
        $this->form->validate($command);
    }
}