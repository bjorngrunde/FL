<?php
namespace Family\Forms;


use Laracasts\Validation\FormValidator;

class PostsForm extends FormValidator
{
    protected $rules = [
        'title'         =>  'required|min:3',
        'body'          =>  'required|min:5|max:65000',
        'img'           =>  'image'
    ];
} 