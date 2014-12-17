<?php
/**
 * Created by PhpStorm.
 * User: Björn
 * Date: 2014-10-26
 * Time: 19:06
 */

namespace Family\Forms;


use Laracasts\Validation\FormValidator;
class LoginForm extends FormValidator
{
    protected $rules = [
        'email'     =>      'required|email',
        'password'  =>      'required'
    ];
} 