<?php
/**
 * Created by PhpStorm.
 * User: Björn
 * Date: 2014-10-26
 * Time: 20:53
 */

namespace Family\Forms;


use Laracasts\Validation\FormValidator;
class RegistrationAutoForm extends FormValidator
{
    protected $rules = [
        'username'  =>      'required|unique:users',
        'email'     =>      'required|email|unique:users',
        'name'      =>      'required',
        'lastName'  =>      'required',
        'rank'      =>      'required',
        'klass'     =>      'required'
    ];
}