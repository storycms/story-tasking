<?php

namespace Story\Tasking;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    public $fillable = [
        'project_id', 'reporter_id', 'type_id', 'priority_id',  'sprint_id', 'sequence', 'name', 'description'
    ];

    public $appends = ['type', 'priority'];

    public function reporter()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function sprint()
    {
        return $this->belongsTo(Sprint::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function getTypeAttribute()
    {
        return new IssueType($this->type_id);
    }

    public function getPriorityAttribute()
    {
        return new IssuePriority($this->priority_id);
    }
}
