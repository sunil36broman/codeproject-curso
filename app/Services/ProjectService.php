<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;
use CodeProject\Validators\ProjectMemberValidator;
use \Prettus\Validator\Exceptions\ValidatorException;

class ProjectService
{
	/**
	 * @var ProjectRepository
	 */
	protected $repository;

	/**
	 * @var ProjectMemberService
	 */
	protected $projectMemberService;

	/**
	 * @var ProjectValidator
	 */
	protected $validator;

	/**
	 * @var ProjectMemberValidator
	 */
	protected $projectMemberValidator;
	
	public function __construct(ProjectRepository $repository, 
								ProjectValidator $validator, 
								ProjectMemberValidator $projectMemberValidator)
	{
		$this->repository = $repository;
		$this->validator = $validator;
		$this->projectMemberValidator = $projectMemberValidator;
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

    /**
     * Add a new member on a project
     * @param int $projectId 
     * @param int $memberId  
     * @return mix
     */
    public function addMember($data){
       	try {

       		$this->projectMemberValidator->with( $data )->passesOrFail();
    		
			return $this->repository->addMember($data['project_id'] ,$data['user_id']);

		} catch (ValidatorException $e) {

			return [
					'error'   => true,
					'message' => $e->getMessageBag()
				];
		}       	
    }

    /**
     * remove a  member from a project
     * @param int $projectId 
     * @param int $memberId  
     * @return mix
     */
    public function removeMember($projectId, $memberId){
       	try {

			return $this->repository->removeMember($projectId, $memberId);

		} catch (ValidatorException $e) {

			return [
					'error'   => true,
					'message' => $e->getMessageBag()
				];
		}       	
    }
}