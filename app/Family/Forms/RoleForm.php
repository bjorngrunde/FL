<?php

namespace Family\Forms;


use Laracasts\Validation\FormValidator;

class RoleForm extends FormValidator
{
    protected $rules = [
        'role' =>   'required'
    ];
} 