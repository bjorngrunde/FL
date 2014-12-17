<?php

namespace Family\Forms;

use Laracasts\Validation\FormValidator;

class EventValidation extends FormValidator
{
    protected $rules = [
        'id'             =>      'required',
        'description'       =>      'required',
        'time'              =>      'required|date',
        'startTime'         =>      'required',
        'endTime'           =>      'required'
    ];
}