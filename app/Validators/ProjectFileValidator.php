<?php

namespace CodeProject\Validators;

use Prettus\Validator\LaravelValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

class ProjectFileValidator  extends LaravelValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
	        'project_id' => 'required|integer',
	        'file'=> 'required',
	        'name'=> 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
	        'project_id' => 'required|integer',
        ]
   ];
}
