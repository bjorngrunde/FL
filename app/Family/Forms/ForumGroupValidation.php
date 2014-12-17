<?php
namespace Family\Forms;

use Laracasts\Validation\FormValidator;

class ForumGroupValidation extends FormValidator
{
protected $rules = [
    'title'           =>      'required'
];
}