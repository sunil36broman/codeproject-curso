<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;
use \Prettus\Validator\Exceptions\ValidatorException;

class ProjectService extends ServiceAbstract
{
	/**
	 * @var ProjectRepository
	 */
	protected $repository;

	/**
	 * @var ProjectValidator
	 */
	protected $validator;
	
	public function __construct(ProjectRepository $repository, ProjectValidator $validator)
	{
		$this->repository = $repository;
		$this->validator = $validator;
	}

	/**
	 * Get all projects
	 * @return array Entities\Project
	 */
	public function all()
	{
		return $this->repository->with(['owner', 'client'])->all();
	}

    /**
     * get a Project
     *
     * @param  int  $id
     * @return Entities\Project
     */
    public function find($id)
    {       
       return $this->repository->with(['owner', 'client'])->find($id);
    }
}