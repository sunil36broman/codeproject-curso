<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Repositories\ProjectTaskRepository;
use CodeProject\Services\ProjectTaskService;

class ProjectTaskController extends Controller
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
    public function __construct(ProjectTaskRepository $repository, ProjectTaskService $service)
    {
        $this->middleware('project-permission', ['only' => ['show', 'store', 'update', 'destroy']]);
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id)
    {
        return $this->repository->findWhere(['project_id' => $id]);
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
    public function show($projectId, $taskId)
    {
       return $this->repository->findWhere(['project_id' => $projectId, 'id' => $taskId]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $projectId, $taskId)
    {
        return $this->service->update($request->all(), $taskId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($projectId, $taskId)
    {
       return ['success' => $this->repository->delete($taskId)];
    }
}
