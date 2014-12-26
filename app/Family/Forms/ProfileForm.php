<?php
namespace Family\Forms;
use Laracasts\Validation\FormValidator;

class ProfileForm extends FormValidator
{
    protected $rules = [
        'name'      =>  'required',
        'lastName'  =>  'required',
        'phone'     =>  'numeric'
    ];
} 