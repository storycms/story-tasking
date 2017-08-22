<?php

namespace Story\Tasking;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $fillable = ['name', 'slug', 'description'];

    public function user()
    {
        return $this->belongsToMany(
            \App\User::class, 'user_project', 'project_id', 'user_id'
        )->withPivot('type');
    }

    public function issue()
    {
        return $this->hasMany(Issue::class);
    }

    public function sprint()
    {
        return $this->hasMany(Sprint::class);
    }
}
