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

    public function notes()
    {
        return $this->hasMany(ProjectNote::class);
    }

    public function owner()
    {
        return $this->hasOne(User::class, 'id','owner_id');
    }

    public function client()
    {
        return $this->hasOne(Client::class, 'id','client_id');
    }
}
