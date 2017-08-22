<?php

namespace Story\Tasking\Http\Controllers;

class BacklogController extends Controller
{
    protected $issues;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return response()->json([
            'data' => [
                'issues' => [],
                'sprints' => [],
            ]
        ]);
    }
}
