<?php

namespace Story\Tasking\Http\Controllers;

use Illuminate\Http\Request;
use Story\Tasking\Contracts\IssueRepositoryInterface;
use Story\Tasking\Contracts\ProjectRepositoryInterface;

class IssueController extends Controller
{
    /**
     * The issue repository implementation.
     *
     * @var \Story\Tasking\Contracts\IssueRepositoryInterface
     */
    protected $issues;

    /**
     * The project repository implementation.
     *
     * @var \Story\Tasking\Contracts\ProjectRepositoryInterface
     */
    protected $projects;

    /**
     * Create a new controller instance
     *
     * @param \Story\Tasking\Contracts\IssueRepositoryInterface $issues
     * @param \Story\Tasking\Contracts\ProjectRepositoryInterface $projects
     */
    public function __construct(IssueRepositoryInterface $issues, ProjectRepositoryInterface $projects)
    {
        $this->middleware('auth');

        $this->issues = $issues;
        $this->projects = $projects;
    }

    /**
     * Show all issue from given projectId
     *
     * @param \Illumminate\Http\Request $request
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $slug)
    {
        $user = $request->user();
        $project = $this->projects->getProject($user, $slug);
        $issues = $this->issues->getAllIssueForProject($project);

        return response()->json(['data' => $issues]);
    }

    /**
     * Create new issue.
     *
     * @param \Illumminate\Http\Request $request
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $slug)
    {
        $this->validate($request, ['name' => 'required']);

        $user = $request->user();
        $project = $this->projects->getProject($user, $slug);
        $issue = $this->issues->create($project, $user, $request->all());

        if ($issue) {
            return response()->json(['data' => $issue->load('reporter')]);
        }
        return response()->json([], 422);

    }

    /**
     * Show issue from given id
     *
     * @param \Illumminate\Http\Request $request
     * @param string $slug
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug, $id)
    {
        $user = $request->user();
        $project = $this->projects->getProject($user, $slug);
        $issue = $this->issues->getIssueForProject($project, $id);

        return response()->json(['data' => $issue]);
    }

    /**
     * Update the current issue givent Id
     *
     * @param \Illumminate\Http\Request $request
     * @param string $slug
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug, $id)
    {
        $user = $request->user();
        $project = $this->projects->getProject($user, $slug);

        if ($issue = $this->issues->getIssue($project, $id)
            && $this->issues->update($issue, $request->all())) {
            return response()->json([]);
        }

        return response()->json([], 422);
    }
}
