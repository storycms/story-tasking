<?php

use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function() {

    // API resources
    Route::resource('project', 'ProjectController');
    Route::resource('project/{project}/issue', 'IssueController');
    Route::resource('issue/{id}/comment', 'CommentController', ['only' => ['index', 'store', 'update', 'destroy']]);

    Route::get('project/{project}/backlog', 'BacklogController@index')->name('backlog.index');
    Route::get('project/{project}/sprint', 'SprintController@index')->name('sprint.index');
    Route::post('project/{project}/sprint', 'SprintController@store')->name('sprint.store');
    Route::put('project/{project}/sprint/{sprint}', 'SprintController@update')->name('sprint.update');
    Route::put('project/{project}/sprint/{sprint}/start', 'SprintController@start')->name('sprint.start');

});

// Catch-all routes
Route::get('/', 'HomeController@index');
Route::get('/{view}', 'HomeController@index')->where('view', '(.*)');
