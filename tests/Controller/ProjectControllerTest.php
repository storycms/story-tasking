<?php

namespace Story\Tasking\Tests\Controller;

use Mockery;
use Story\Tasking\Contracts\ProjectRepositoryInterface;

class ProjectControllerTest extends AbstractControllerTest
{
    public function test_visit_projects()
    {
        $projects = Mockery::mock(ProjectRepositoryInterface::class);
        $projects->shouldReceive('getAllProjectForUser')->andReturn([]);

        $this->app->instance(ProjectRepositoryInterface::class, $projects);

        $response = $this->actingAs(new Fakes\User)->get('/tasking/api/project');

        $response->assertJson(['data' => []]);
    }
}
