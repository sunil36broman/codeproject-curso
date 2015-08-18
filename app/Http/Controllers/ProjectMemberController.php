<?php

namespace CodeProject\Http\Controllers;


use Illuminate\Http\Request;
use CodeProject\Services\ProjectMemberService;

class ProjectMemberController extends Controller
{

    /**
     * @var ProjectMemberRepository
     */
    protected $repository;

    /**
     * @var ProjectMemberRepository
     */
    protected $service;

    /**
     * Instantiate a new Controller instance.
     *
     * @return void
     */
    public function __construct(ProjectMemberService $service)
    {
        $this->middleware('project-permission', ['only' => ['show', 'store', 'update', 'destroy']]);
        $this->service = $service;
    }

    /**
     * Display a listing of the members from a project.
     *
     * @return Response
     */
    public function index($projectId)
    {
        return $this->service->getMembers($projectId);
    }

    /**
     * Display a member from a project
     *
     * @return Response
     */
    public function show($projectId, $memberId)
    {
        return $this->service->getMember($projectId, $memberId);
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