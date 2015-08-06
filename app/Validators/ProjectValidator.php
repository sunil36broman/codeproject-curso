<?php

namespace CodeProject\Validators;

use Prettus\Validator\LaravelValidator;

class ProjectValidator  extends LaravelValidator
{
    protected $rules = [
        'owner_id' => 'required|integer',
        'client_id'  => 'required|integer',
        'name'=> 'required',
       // 'description'=> 'required',
        'progress'=> 'required|integer|between:0,100',
        'status'=> 'required|integer|min:0',
        'due_date'=> 'required|date_format:"Y-m-d"',
    ];
}