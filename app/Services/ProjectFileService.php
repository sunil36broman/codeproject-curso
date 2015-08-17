<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectFileRepository;
use CodeProject\Validators\ProjectFileValidator;
use \Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;

class ProjectFileService
{
	/**
	 * @var ProjectRepository
	 */
	protected $repository;

	/**
	 * @var ProjectValidator
	 */
	protected $validator;

	/**
	 * @var Filesystem
	 */
	protected $fileSystem;

	/**
	 * @var Storage
	 */
	protected $storage;
	
	public function __construct(ProjectFileRepository $repository, 
								ProjectFileValidator $validator, 
								Filesystem $fileSystem, 
								Storage $storage)
	{
		$this->repository = $repository;
		$this->validator = $validator;
		$this->fileSystem = $fileSystem;
		$this->storage = $storage;
	}

	public function upload(array $data)
	{
		
		try {

			$this->validator->with( $data )->passesOrFail(ValidatorInterface::RULE_CREATE );

			$model = $this->repository->skipPresenter()->create( $data );

			$this->storage->put($model->id . "." . $data['extension'], $this->fileSystem->get($data['file']));

			return $model;

		} catch (ValidatorException $e) {

			return [
					'error'   => true,
					'message' => $e->getMessageBag()
				];
		}
	}

	public function update(array $data, $fileId)
	{
		
		try {

			$this->validator->with( $data )->passesOrFail(ValidatorInterface::RULE_UPDATE );

			if($data['file'] != NULL){
				$this->storage->put($fileId . "." . $data['extension'], $this->fileSystem->get($data['file']));
			}else{
				unset($data['file']);
				unset($data['extension']);
			}	

			if(empty($data['name'])){
				unset($data['name']);
			}	

			if(empty($data['description'])){
				unset($data['description']);
			}	

			return $this->repository->update($data, $fileId);			

		} catch (ValidatorException $e) {

			return [
					'error'   => true,
					'message' => $e->getMessageBag()
				];
		}
	}

	public function delete($fileId)
	{

		$model = $this->repository->skipPresenter()->find($fileId);
		$this->storage->delete($fileId . "." . $model->extension);
		return $this->repository->delete($fileId);
	}
}