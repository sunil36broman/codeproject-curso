<?php

namespace CodeProject\Services;

use \Prettus\Validator\Exceptions\ValidatorException;

abstract class ServiceAbstract
{

	/**
	 * @var ProjectRepository
	 */
	protected $repository;

	/**
	 * @var ProjectValidator
	 */
	protected $validator;


	public function all()
	{
		return $this->repository->all();
	}

    public function find($id)
    {       
       return $this->repository->find($id);
    }

	public function create(array $data)
	{
		$this->validator->with( $data )->passesOrFail();

		return $this->repository->create( $data );
	}

	public function update(array $data, $id)
	{		
		$this->validator->with( $data )->passesOrFail();

		return $this->repository->update($data, $id);      
	}

	public function delete($id)
	{		
		return $this->repository->delete($id);      
	}
}