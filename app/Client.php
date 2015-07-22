<?php

namespace CodeProject;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    		'name',
    		'responsible',
    		'address',
    		'email',
    		'phone',
    		'obs',
    	];
}
