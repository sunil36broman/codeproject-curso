<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectMemberValidator;
use \Prettus\Validator\Exceptions\ValidatorException;

class ProjectMemberService extends ServiceAbstract
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
	 * Construct a instance of service
	 * @param ProjectRepository      $repository 
	 * @param ProjectMemberValidator $validator  
	 */
	public function __construct(ProjectRepository $repository, ProjectMemberValidator $validator)
	{
		$this->repository = $repository;
		$this->validator = $validator;
	}

    /**
     * Get all members from a project
     * @param  integer $projectId 
     * @return array Project         
     */
    public function getMembers($projectId)
    {
        return $this->repository->getMembers($projectId);
    }

    /**
     * Get a member
     * @param  integer $projectId 
     * @param  integer $memberId 
     * @return obj User      
     */
    public function getMember($projectId, $memberId)
    {
        return $this->repository->getMember($projectId, $memberId);
    }

    /**
     * Add a new member on a project
     * @param int $projectId 
     * @param int $memberId  
     * @return mix
     */
    public function addMember($data)
    {
    	$this->validator->with( $data )->passesOrFail();

    	return $this->repository->addMember($data['project_id'] ,$data['user_id']);  	
    }

    /**
     * remove a  member from a project
     * @param int $projectId 
     * @param int $memberId  
     * @return mix
     */
    public function removeMember($projectId, $memberId)
    {
    	return $this->repository->removeMember($projectId, $memberId);    	
    }
}