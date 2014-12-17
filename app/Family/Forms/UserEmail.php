<?php

namespace Family\Forms;


use Laracasts\Validation\FormValidator;

class UserEmail extends FormValidator
{
    protected $rules = [
        'email' => 'required|email|unique:users'
    ];
} 