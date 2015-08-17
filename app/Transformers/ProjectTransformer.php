<?php

namespace CodeProject\Transformers;

use League\Fractal\TransformerAbstract;
use CodeProject\Entities\Project;
use CodeProject\Transformers\ProjectClientTransformer;
use CodeProject\Transformers\ProjectOwnerTransformer;
use CodeProject\Transformers\ProjectMemberTransformer;

/**
 * Class ProjectTransformerTransformer
 * @package namespace CodeProject\Transformers;
 */
class ProjectTransformer extends TransformerAbstract
{

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'client',
        'owner',
        'members',
        'files',
    ];

    /**
     * Transform the \ProjectTransformer entity
     * @param \ProjectTransformer $model
     *
     * @return array
     */
    public function transform(Project $model) {
        return [
            'project_id'    =>  $model->id,
            'project'       =>  $model->name,
            'description'   =>  $model->description,
            'progress'      =>  $model->progress,
            'status'        =>  $model->status,
            'due_date'      =>  $model->due_date->toDateString(),
            'created_at'    =>  $model->created_at->toDateTimeString(),
            'updated_at'    =>  $model->updated_at->toDateTimeString(),
        ];
    }

    /**
     * Include Client
     *
     * @return League\Fractal\ItemResource
     */
    public function includeClient(Project $model)
    {
        return $this->item($model->client, new ProjectClientTransformer());
    }

    /**
     * Include Owner
     *
     * @return League\Fractal\ItemResource
     */
    public function includeOwner(Project $model)
    {
        return $this->item($model->owner, new ProjectOwnerTransformer());
    }

    /**
     * Include Members
     *
     * @return League\Fractal\ItemResource
     */
    public function includeMembers(Project $model)
    {
        return $this->collection($model->members, new ProjectMemberTransformer());
    }

    /**
     * Include Files
     *
     * @return League\Fractal\ItemResource
     */
    public function includeFiles(Project $model)
    {
        return $this->collection($model->files, new ProjectFileTransformer());
    }
}