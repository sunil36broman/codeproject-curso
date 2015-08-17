<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProjectTask extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
	    'id',
	    'name',
	    'project_id', 
	    'start_date',
	    'due_date',
	    'status',
	    'created_at',
	    'updated_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'start_date', 
        'due_date',
    ];

    /**
     * Get project
     * @return CodeProject\Entities\Project
     */
    public function project()
    {
    	return $this->belongsTo(Project::class);
    }

}
