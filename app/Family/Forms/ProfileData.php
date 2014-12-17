<?php

namespace Family\Forms;


use Laracasts\Validation\FormValidator;

class ProfileData extends FormValidator
{
    protected $rules = [
        'name'      =>  'required',
        'lastName'  =>  'required',
        'phone'     =>  'numeric'
    ];
} 