<?php

namespace CodeProject\Http\Controllers;


use Illuminate\Http\Request;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;

class ProjectMemberController extends Controller
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
        $this->middleware('project-permission', ['only' => ['show', 'store', 'update', 'destroy']]);
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the members from a project.
     *
     * @return Response
     */
    public function index($id)
    {
        return $this->repository->find($id)->members;
    }

    /**
     * Display a member from a project
     *
     * @return Response
     */
    public function show($projectId, $memberId)
    {
        return $this->repository->getMember($projectId, $memberId);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request, $projectId)
    {
        return ['success' => $this->service->addMember($request->all())];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function destroy($projectId, $memberId)
    {
        return ['success' => $this->service->removeMember($projectId, $memberId)];
    }

}