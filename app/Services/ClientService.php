<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ClientRepository;
use CodeProject\Validators\ClientValidator;
use \Prettus\Validator\Exceptions\ValidatorException;

class ClientService extends ServiceAbstract
{
	/**
	 * @var ClientRepository
	 */
	protected $repository;

	/**
	 * @var ClientValidator
	 */
	protected $validator;
	
	public function __construct(ClientRepository $repository, ClientValidator $validator)
	{
		$this->repository = $repository;
		$this->validator = $validator;
	}

	public function all()
	{
		return $this->repository->skipPresenter()->all();
	}
}
