<?php
namespace Family\Forms;

use Laracasts\Validation\FormValidator;

class ForumCommentForm extends FormValidator
{
    protected $rules = [
        'body'           =>      'required|min:3|max:65000'
    ];
}