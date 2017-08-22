<?php

namespace Story\Tasking\Http\Controllers;

use Illuminate\Http\Request;
use Story\Tasking\Contracts\ProjectRepositoryInterface;
use Story\Tasking\Contracts\SprintRepositoryInterface;

class SprintController extends Controller
{
    /**
     * The project repository implementation.
     *
     * @var \Story\Tasking\Contracts\ProjectRepositoryInterface
     */
    protected $projects;

    /**
     * The sprint repository implementation.
     *
     * @var \Story\Tasking\Contracts\SprintRepositoryInterface
     */
    protected $sprints;

    /**
     * Create new controller instance.
     *
     * @param \Story\Tasking\Contracts\ProjectRepositoryInterface $projects
     * @param \Story\Tasking\Contracts\SprintRepositoryInterface $sprints
     */
    public function __construct(ProjectRepositoryInterface $projects, SprintRepositoryInterface $sprints)
    {
        $this->middleware('auth');

        $this->projects = $projects;
        $this->sprints = $sprints;
    }

    /**
     * Get all sprint for given project ID
     *
     * @param Request $request
     * @param string $project
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $project)
    {
        $project = $this->projects->getProject($request->user(), $project);
        $sprints = $this->sprints->getAllSprintForProject($project);

        return response()->json(['data' => $sprints]);
    }

    /**
     * Create new sprint.
     *
     * @param Request $request
     * @param string $project
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $project)
    {
        $project = $this->projects->getProject($request->user(), $project);

        if ($sprint = $this->sprints->create($project, $request->user(), $request->all())) {
            return response()->json([
                'data' => $sprint
            ]);
        }

        return response()->json([], 422);
    }

    /**
     * Update sprint data for given sprint ID
     *
     * @param Request $request
     * @param string $project
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $project, $id)
    {
        $project = $this->projects->getProject($request->user(), $project);
        $sprint = $this->sprints->getSprint($project, $id);

        if ($this->sprints->update($sprint, $request->all())) {
            return response()->json();
        }

        return response()->json([], 422);
    }

    /**
     * Start the sprint.
     *
     * @param Request $request
     * @param string $project
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function start(Request $request, $project, $id)
    {
        $project = $this->projects->getProject($request->user(), $project);
        $sprint = $this->sprints->getSprint($project, $id);

        if ($this->sprints->start($sprint)) {
            return response()->json();
        }

        return response()->json([], 422);
    }
}
