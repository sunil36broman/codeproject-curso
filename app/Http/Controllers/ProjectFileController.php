<?php

namespace CodeProject\Http\Controllers;


use Illuminate\Http\Request;
use CodeProject\Repositories\ProjectFileRepository;
use CodeProject\Services\ProjectFileService;

class ProjectFileController extends Controller
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
    public function __construct(ProjectFileRepository $repository, ProjectFileService $service)
    {
        $this->middleware('project-permission', ['only' => ['show', 'store','update', 'destroy']]);
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
    public function store(Request $request, $projectId)
    {

        if (! $request->hasFile('file')) {
            return response()->json([
                'error'=> true, 
                'message' => 'the field file is required'
                ], 422);
        }

        if (! $request->file('file')->isValid())
        {
            return response()->json([
                'error'=> true, 
                'message' => 'Sorry, it was not possible to complete the upload file'
                ], 422);
        }


        $data = [
            'project_id' => $projectId,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'file' => $request->file('file'),
            'extension' => $request->file('file')->getClientOriginalExtension(),
        ];

        return $this->service->upload($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($projectId, $fileId)
    {
       return $this->repository->findWhere(['project_id' => $projectId, 'id' => $fileId]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $projectId, $fileId)
    {
        $file = NULL;
        $extension = NULL;

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
        }

        $data = [
            'project_id' => $projectId,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'file' => $file,
            'extension' => $extension,
        ];

        return $this->service->update($data, $fileId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($projectId, $fileId)
    {
       return ['success' => $this->service->delete($fileId)];
    }
}
