<?php

namespace Family\Forms;


use Laracasts\Validation\FormValidator;

class NewThreadForm extends FormValidator
{
    protected $rules = [
        'title'      =>  'required|min:3|max:255',
        'body'  =>  'required||min:5|max:65000',
    ];
}