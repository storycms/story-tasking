<?php

namespace Story\Tasking;

trait ServiceBindings
{
    /**
     * All of the service bindings for Tasking
     *
     * @var array
     */
    protected $bindings = [
        // Repository services ...
        Contracts\CommentRepositoryInterface::class => Repositories\CommentRepository::class,
        Contracts\IssueRepositoryInterface::class => Repositories\IssueRepository::class,
        Contracts\LabelRepositoryInterface::class => Repositories\LabelRepository::class,
        Contracts\ProjectRepositoryInterface::class => Repositories\ProjectRepository::class,
        Contracts\SprintRepositoryInterface::class => Repositories\SprintRepository::class
    ];
}
