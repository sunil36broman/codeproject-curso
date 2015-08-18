<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectTaskRepository;
use CodeProject\Validators\ProjectTaskValidator;
use \Prettus\Validator\Exceptions\ValidatorException;

class ProjectTaskService extends ServiceAbstract
{
	/**
	 * @var ProjectRepository
	 */
	protected $repository;

	/**
	 * @var ProjectValidator
	 */
	protected $validator;
	
	public function __construct(ProjectTaskRepository $repository, ProjectTaskValidator $validator)
	{
		$this->repository = $repository;
		$this->validator = $validator;
	}
}