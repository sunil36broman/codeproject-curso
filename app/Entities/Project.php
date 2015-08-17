<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Project extends Model implements Transformable
{
    use TransformableTrait;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'owner_id',
        'client_id',
        'name',
        'description',
        'progress',
        'status',
        'due_date',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'due_date',
    ];

    /**
     * Get Owner
     * @return CodeProject\Entities\User
     */
    public function owner()
    {
        return $this->hasOne(User::class, 'id','owner_id');
    }

    /**
     * Get Client
     * @return CodeProject\Entities\Client
     */
    public function client()
    {
        return $this->hasOne(Client::class, 'id','client_id');
    }

    /**
     * Get Notes
     * @return array CodeProject\Entities\ProjectNote
     */
    public function notes()
    {
        return $this->hasMany(ProjectNote::class);
    }

    /**
     * Get members
     * @return array CodeProject\Entities\ProjectTask
     */
    public function members()
    {
        return $this->belongsToMany(User::class, 'project_members', 'project_id', 'user_id');
    }

    /**
     * Get tasks
     * @return array CodeProject\Entities\ProjectTask
     */
    public function tasks()
    {
        return $this->hasMany(ProjectTask::class);
    }

    /**
     * Get Files
     * @return array CodeProject\Entities\ProjectFile
     */
    public function files()
    {
        return $this->hasMany(ProjectFile::class);
    }
}
