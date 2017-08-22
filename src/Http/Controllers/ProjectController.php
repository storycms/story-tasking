<?php

namespace Story\Tasking\Http\Controllers;

use Illuminate\Http\Request;
use Story\Tasking\Contracts\ProjectRepositoryInterface;

class ProjectController extends Controller
{
    protected $projects;

    /**
     * Create a new controller instance.
     *
     * @param \Story\Tasking\Contracts\ProjectRepositoryInterface $projects
     */
    public function __construct(ProjectRepositoryInterface $projects)
    {
        $this->middleware('auth');

        $this->projects = $projects;
    }

    /**
     * Get project by username
     *
     * @return void
     */
    public function index(Request $request)
    {
        $projects = $this->projects->getAllProjectForUser($request->user());

        return response()->json([
            'data' => $projects
        ]);
    }

    /**
     * Create new project.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Iluminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required|unique:projects'
        ]);

        $params = $request->only('name', 'slug', 'description');
        $project = $this->projects->create($request->user(), $params);

        if ($project) {
            return response()->json(['data' => $project]);
        }
        return response()->json([], 422);
    }

    /**
     * Get project by slug
     *
     * @param Request $request
     * @param int $projectId
     * @return \Iluminate\Http\Response
     */
    public function show(Request $request, int $projectId)
    {
        $project = $this->projects->getProject($request->user(), $projectId);

        return response()->json([
            'data' => $project
        ]);
    }
}
