<?php

namespace Story\Tasking;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $fillable = ['comment', 'issue_id', 'user_id'];

    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
