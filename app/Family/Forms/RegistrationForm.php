<?php
/**
 * Created by PhpStorm.
 * User: Björn
 * Date: 2014-10-26
 * Time: 14:03
 */

namespace Family\Forms;

use Laracasts\Validation\FormValidator;
class RegistrationForm extends FormValidator
{
    protected $rules = [
        'username'  =>      'required|unique:users',
        'email'     =>      'required|email|unique:users',
        'klass'     =>      'required',
        'rank'      =>      'required',
        'name'      =>      'required',
        'lastName'  =>      'required'
    ];
} 