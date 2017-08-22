<?php

namespace Story\Tasking;

trait EventMap
{
    /**
     * All of the Hook event/ listener mappings.
     *
     * @var array
     */
    protected $events = [
        'Story\Tasking\Event\ProjectCreated' => [
            'Story\Tasking\Listeners\ProjectStored'
        ]
    ];
}
