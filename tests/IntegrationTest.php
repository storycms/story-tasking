<?php

namespace Story\Tasking\Tests;

use Orchestra\Testbench\TestCase;

abstract class IntegrationTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return ['Story\Tasking\TaskingServiceProvider'];
    }

    protected function getEnvirontmentSetUp($app)
    {
        // $app['config']->set('')
    }
}
