<?php

namespace Story\Tasking\Repositories;

use Story\Tasking\Project;
use Story\Tasking\Contracts\ProjectRepositoryInterface;
use Illuminate\Contracts\Auth\Authenticatable;

class ProjectRepository implements ProjectRepositoryInterface
{

    /**
     * Create a new team for the given user and data.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $data
     * @return \Story\Tasking\Project
     */
    public function create(Authenticatable $user, $data)
    {
        $project = Project::create([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description']
        ]);

        $user->project()->attach($project, ['type' => 'owner']);

        return $this->getProject($user, $project->slug);
    }

    /**
     * Get the project for the given ID
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  int  $projectId
     * @return void
     */
    public function getProject(Authenticatable $user, $projectId)
    {
        return $user->project()->with('user')->findOrFail($projectId);
    }

    /**
     * Get all project for the given ID
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllProjectForUser(Authenticatable $user)
    {
        return $user->project()->get();
    }
}
