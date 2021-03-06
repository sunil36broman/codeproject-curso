<?php

namespace CodeProject\Transformers;

use League\Fractal\TransformerAbstract;
use CodeProject\Entities\ProjectFile;

/**
 * Class ProjectFileTransformer
 * @package namespace CodeProject\Transformers;
 */
class ProjectFileTransformer extends TransformerAbstract
{

    /**
     * Transform the \ProjectFile entity
     * @param \ProjectFile $model
     *
     * @return array
     */
    public function transform(ProjectFile $model) {
        return [
            'file_id'       =>  $model->id,
            'file'          =>  $model->name,
            'extension'     =>  $model->extension,
            'created_at'    =>  $model->created_at->toDateTimeString(),
            'updated_at'    =>  $model->updated_at->toDateTimeString(),
        ];
    }
}