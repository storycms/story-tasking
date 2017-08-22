<?php

namespace Story\Tasking;

use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    const STATE_STARTED = 'started';
    const STATE_ENDED = 'ended';
    const STATE_FUTURE = 'future';

    public $fillable = [
        'reporter_id', 'project_id', 'sequence',
        'name', 'description', 'start_date', 'end_date', 'complete_date'
    ];

    public $dates = ['start_date', 'end_date', 'complete_date'];

    public function issue()
    {
        return $this->hasMany(Issue::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

}
