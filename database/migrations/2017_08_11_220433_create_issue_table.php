<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->integer('reporter_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->integer('priority_id')->unsigned();
            $table->integer('sprint_id')->unsigned()->nullable();
            $table->integer('issue_id')->unsigned()->nullable();
            $table->integer('sequence');
            $table->text('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issues');
    }
}
