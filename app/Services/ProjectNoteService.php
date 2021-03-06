<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Validators\ProjectNoteValidator;
use \Prettus\Validator\Exceptions\ValidatorException;

class ProjectNoteService extends ServiceAbstract
{
	/**
	 * @var ProjectRepository
	 */
	protected $repository;

	/**
	 * @var ProjectValidator
	 */
	protected $validator;
	
	public function __construct(ProjectNoteRepository $repository, ProjectNoteValidator $validator)
	{
		$this->repository = $repository;
		$this->validator = $validator;
	}

    public function getAllByProject($projectId)
    {
        return $this->repository->findWhere(['project_id' => $projectId]);
    }

	public function create(array $data)
	{
		
		try {

			$this->validator->with( $data )->passesOrFail();

			return $this->repository->create( $data );

		} catch (ValidatorException $e) {

			return [
					'error'   => true,
					'message' => $e->getMessageBag()
				];
		}
	}

    public function update(array $data, $id)
    {
    	try {
    		
    		$this->validator->with( $data )->passesOrFail();

			return $this->repository->update($data, $id);

		} catch (ValidatorException $e) {

			return [
					'error'   => true,
					'message' => $e->getMessageBag()
				];
		}        
    }
}