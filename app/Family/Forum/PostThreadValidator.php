<?php
use Family\Forms\NewThreadForm;
use Family\Forum\PostThreadCommand;

class PostThreadValidator
{
    private $form;

    public function __construct(NewThreadForm $form)
    {
        $this->form = $form;
    }

    public function validate(PostThreadCommand $command)
    {
        $this->form->validate($command);
    }
}