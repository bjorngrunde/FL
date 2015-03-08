<?php

namespace Family\Forum;

use Family\Forms\ForumCommentForm;
use Family\Forum\PostCommentCommand;

class PostCommentValidator
{
    private $form;

    public function __construct(ForumCommentForm $form)
    {
        $this->form = $form;
    }

    public function validate(PostCommentCommand $command)
    {
        $this->form->validate($command);
    }
}