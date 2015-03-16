<?php

namespace Family\Comments;

use Comment;
use Family\Comments\PostCommentCommand;
class lol
{
    public function validate(PostCommentCommand $command)
    {
        $rules = Comment::getRules($command->commentable_type);
        $validator = Validator::make($command, $rules);
        if($validator->fails())
        {
            return Redirect::back()->withErrors($validator);
        }
    }
} 