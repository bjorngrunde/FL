<?php

namespace Family\Forms;


use Laracasts\Validation\FormValidator;

class RaidForm extends FormValidator
{
    protected $rules = [
        'title'             => 'required',
        'backgroundImg'     => 'image'
    ];
} 