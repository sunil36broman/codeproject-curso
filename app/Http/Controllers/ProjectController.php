<?php

namespace CodeProject\Http\Controllers;


use Illuminate\Http\Request;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;
use Autorizer;

class ProjectController extends Controller
{

    /**
     * @var ProjectRepository
     */
    protected $repository;

    /**
     * @var ProjectRepository
     */
    protected $service;

    /**
     * Instantiate a new Controller instance.
     *
     * @return void
     */
    public function __construct(ProjectRepository $repository, ProjectService $service)
    {
        $this->middleware('project-permission', ['only' => ['show', 'update', 'destroy']]);
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->repository->with(['owner', 'client'])->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {       
       return $this->repository->with(['owner', 'client'])->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        return ['success' => $this->repository->delete($id)];
    }

    /**
     * Display a listing of the members from a project.
     *
     * @return Response
     */
    public function members($id)
    {
        return $this->repository->find($id)->members;
    }

    /**
     * Display a member from a project
     *
     * @return Response
     */
    public function member($projectId, $memberId)
    {
        return $this->repository->getMember($projectId, $memberId);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function addMember(Request $request, $projectId)
    {
        return ['success' => $this->service->addMember($request->all())];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function removeMember($projectId, $memberId)
    {
        return ['success' => $this->service->removeMember($projectId, $memberId)];
    }

    private function checkProjectOwner($projectId)
    {
        $userId = Autorizer::getResourceOwnerId();

        return $this->repository->isOwner($projectId, $userId );
    }

    private function checkProjectMember($projectId)
    {
        $userId = Autorizer::getResourceOwnerId();

        return $this->repository->hasMember($projectId, $userId );
    }


    private function checkProjectPermissons($projectId)
    {
        return (checkProjectOwner($projectId) || checkProjectMember($projectId));
    }
}
