<?php

namespace Story\Tasking\Repositories;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Story\Tasking\Contracts\SprintRepositoryInterface;
use Story\Tasking\Project;
use Story\Tasking\Sprint;

class SprintRepository implements SprintRepositoryInterface
{
    /**
     * Create new sprint for given project ID
     *
     * @param Project $project
     * @param Authenticatable $user
     * @param array $data
     * @return \Story\Tasking\Sprint
     */
    public function create(Project $project, Authenticatable $user, array $data)
    {
        $last = $this->getLastSequenceSprintForProject($project);

        $sprint = new Sprint([
            'name' => 'Sprint ' . ($last + 1),
            'sequence' => $last + 1,
            'state' => Sprint::STATE_FUTURE,
            'reporter_id' => $user->id
        ]);

        return $project->sprint()->save($sprint);
    }

    /**
     * Update sprint data for given sprint ID
     *
     * @param Sprint $sprint
     * @param array $data
     * @return bool
     */
    public function update(Sprint $sprint, array $data)
    {
        $sprint->name = $data['name'];
        $sprint->description = $data['description'];

        return $sprint->save();
    }

    /**
     * Get last sequence number for given project Id
     *
     * @param Project $project
     * @return int
     */
    public function getLastSequenceSprintForProject(Project $project)
    {
        return $project->sprint()->count();
    }

    /**
     * Get all sprint record for given project Id
     *
     * @param Project $project
     * @return void
     */
    public function getAllSprintForProject(Project $project)
    {
        return $project->sprint()->get();
    }

    /**
     * Get the sprint for the given ID
     *
     * @param Project $project
     * @param int $id
     * @return void
     */
    public function getSprint(Project $project, int $id)
    {
        return $project->sprint()->firstOrFail($id);
    }

    /**
     * Start an sprint for given sprint ID
     *
     * @param Sprint $sprint
     * @return void
     */
    public function start(Sprint $sprint)
    {
        $sprint->start_date = Carbon::now();
        $sprint->end_date = Carbon::now()->addDays(14);
        $sprint->state = Sprint::STATE_STARTED;

        return $sprint->save();
    }

    /**
     * Completed an sprint for given sprint
     *
     * @param Sprint $sprint
     * @return void
     */
    public function complete(Sprint $sprint)
    {
        $sprint->state = Sprint::STATE_ENDED;
        $sprint->complete_date = Carbon::now();

        return $sprint->save();
    }
}
