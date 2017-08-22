<?php

namespace Story\Tasking\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Single page application catch-all routes
     *
     * @return void
     */
    public function index()
    {
        return view('tasking::app');
    }
}
