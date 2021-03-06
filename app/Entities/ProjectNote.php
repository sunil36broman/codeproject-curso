<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProjectNote extends Model implements Transformable
{
	use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'project_id',
    	'title',
    	'note',
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