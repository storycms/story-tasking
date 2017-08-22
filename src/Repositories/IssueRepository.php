<?php

namespace Story\Tasking\Repositories;

use Story\Tasking\Sprint;
use Story\Tasking\Project;
use Story\Tasking\Issue;
use Story\Tasking\IssuePriority;
use Story\Tasking\Contracts\IssueRepositoryInterface;
use Illuminate\Contracts\Auth\Authenticatable;

class IssueRepository implements IssueRepositoryInterface
{
    /**
     * Create new issue
     *
     * @param \Story\Tasking\Project $project
     * @param Authenticatable $user
     * @param array $data
     * @return Story\Tasking\Issue
     */
    public function create(Project $project, Authenticatable $user, array $data)
    {
       return Issue::create([
            'sequence' => $this->getLastNumberIssueForProject($project) + 1,
            'project_id' => $project->id,
            'reporter_id' => $user->id,
            'type_id' => $data['type_id'],
            'sprint_id' => isset($data['sprint_id']) ? $data['sprint_id'] : null,
            'priority_id' => isset($data['priority_id']) ? : IssuePriority::MEDIUM,
            'name' => $data['name'],
            'description' => $data['description']
        ]);
    }

    /**
     * Get last number issue from given project ID
     *
     * @param \Story\Tasking\Project $project
     * @return int
     */
    protected function getLastNumberIssueForProject(Project $project)
    {
        return $project->issue()->count();
    }

    /**
     * Get all issue for given projectId
     *
     * @param \Story\Tasking\Project $project
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllIssueForProject(Project $project)
    {
        return $project->issue()->with('reporter')->get();
    }

    /**
     * Get the issue from given ID
     *
     * @param \Story\Tasking\Project $project
     * @param int $number
     * @return \Story\Tasking\Project
     */
    public function getIssueForProject(Project $project, int $number)
    {
        return $project->issue()->where('sequence', $number)->firstOrFail();
    }

    /**
     * Get the issue from given ID
     *
     * @param Authenticatable $user
     * @param int $id
     * @return \Story\Tasking\Issue
     */
    public function getIssue(Authenticatable $user, $id)
    {
        // Get the user projects
        $projects = $user->project()->get()->pluck('id');

        // Filter issue from given project id
        return Issue::whereIn('project_id', $projects)->findOrFail($id);
    }

    /**
     * Update the current issue instance
     *
     * @param \Story\Tasking\Issue $issue
     * @param array $data
     * @return bool
     */
    public function update(Issue $issue, array $data)
    {
        $issue->name = $data['name'];
        $issue->description = $data['description'];

        return $issue->save();
    }
}
