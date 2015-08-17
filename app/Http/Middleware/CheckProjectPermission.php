<?php

namespace CodeProject\Http\Middleware;

use CodeProject\Repositories\ProjectRepository;
use Closure;
use Authorizer;

class CheckProjectPermission
{
    /**
     * @var ProjectRepository
     */
    protected $repository;

    /**
     * Instantiate a new Controller instance.
     *
     * @return void
     */
    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userId = Authorizer::getResourceOwnerId();
        $projectId = $request->project;

        $isOwner = $this->repository->isOwner($projectId, $userId);
        $isMember = $this->repository->hasMember($projectId, $userId);

        if ($isOwner || $isMember){
            return $next($request);
        }

        return ['error' => 'Access Forbiden'];        
    }
}
