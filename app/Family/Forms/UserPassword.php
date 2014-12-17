<?php

namespace Family\Forms;


use Laracasts\Validation\FormValidator;

class UserPassword extends FormValidator
{
    protected $rules = [
        'password' => 'required|confirmed'
    ];
} 