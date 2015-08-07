<?php

namespace CodeProject\Validators;

use Prettus\Validator\LaravelValidator;

class ProjectTaskValidator  extends LaravelValidator
{
    protected $rules = [
        'project_id' => 'required|integer',
        'start_date'=> 'required|date_format:"Y-m-d"',
        'due_date'=> 'required|date_format:"Y-m-d"',
        'status'=> 'required|integer|min:0',
    ];
}
