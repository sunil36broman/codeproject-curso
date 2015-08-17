<?php

namespace CodeProject\Transformers;

use League\Fractal\TransformerAbstract;
use CodeProject\Entities\User;

/**
 * Class ProjectMemberTransformer
 * @package namespace CodeProject\Transformers;
 */
class ProjectMemberTransformer extends TransformerAbstract
{

    /**
     * Transform the \User entity
     * @param \User $model
     *
     * @return array
     */
    public function transform(User $model) {
        return [
            'member_id'     =>  $model->id,
            'member'        =>  $model->name,
            'email'         =>  $model->email,
            'created_at'    =>  $model->created_at->toDateTimeString(),
            'updated_at'    =>  $model->updated_at->toDateTimeString(),
        ];
    }
}