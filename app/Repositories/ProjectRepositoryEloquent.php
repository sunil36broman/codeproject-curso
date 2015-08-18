<?php

namespace CodeProject\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeProject\Entities\Project;
use CodeProject\Presenters\ProjectPresenter;

/**
 * Class ProjectRepositoryEloquent
 * @package namespace CodeProject\Repositories;
 */
class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Project::class;
    }

    /**
     * Specify Presenter class name
     *
     * @return string
     */
    public function presenter()
    {
        return ProjectPresenter::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria( app(RequestCriteria::class) );
    }

    /**
     * Get owner on a project
     * @param int $projectId 
     * @param int $memberId  
     * @return mix
     */
    public function getOwner($projectId, $userId)
    {
        return $this->skipPresenter()->findWhere(['id' => $projectId, 'owner_id' => $userId]);
    }

    /**
     * Get a member on a project
     * @param int $projectId 
     * @param int $memberId  
     * @return mix
     */
    public function getMember($projectId, $userId)
    {
       $project = $this->skipPresenter()->find($projectId);

       foreach ($project->members as $member) {
           if($member->id == $userId){
                return $member;
           }
       }

        return NULL;
    }

    /**
     * Get a member on a project
     * @param int $projectId 
     * @param int $memberId  
     * @return mix
     */
    public function getMembers($projectId)
    {
       return $this->skipPresenter()->find($projectId)->members;
    }

    /**
     * Add a new member on a project
     * @param int $projectId 
     * @param int $memberId  
     * @return mix
     */
    public function addMember($projectId ,$userId)
    {
        $this->skipPresenter()->find($projectId)->members()->attach($userId); 

        return TRUE;         
    }

    /**
     * remove a  member from a project
     * @param int $projectId 
     * @param int $memberId  
     * @return mix
     */
    public function removeMember($projectId ,$userId)
    {       
        $this->skipPresenter()->find($projectId)->members()->detach($userId); 

        return  TRUE;      
    }

    /**
     * Check if exists a owner on a project
     * @param int $projectId 
     * @param int $memberId  
     * @return mix
     */
    public function isOwner($projectId, $userId)
    {
        if(count($this->getOwner($projectId, $userId))){
            return TRUE;
        }

        return FALSE;
    }

    /**
     * Check if exists a member on a project
     * @param int $projectId 
     * @param int $memberId  
     * @return mixn
     */
    public function hasMember($projectId, $userId)
    {
        if($this->getMember($projectId, $userId) != NULL){
            return TRUE;
        }

        return FALSE;
    }
}