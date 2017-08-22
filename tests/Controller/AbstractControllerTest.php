<?php

namespace Story\Tasking\Tests\Controller;

use Story\Tasking\Tests\IntegrationTest;
use Story\Tasking\Tasking;

abstract class AbstractControllerTest extends IntegrationTest
{
    public function setUp()
    {
        parent::setUp();

        $this->app['config']->set('app.key', 'base64:UTyp33UhGolgzCK5CJmT+hNHcA+dJyp3+oINtX+VoPI=');

        Tasking::auth(function() {
            return true;
        });
    }
}
