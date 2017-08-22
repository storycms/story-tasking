<?php

namespace Story\Tasking;

use Creativeorange\Gravatar\Facades\Gravatar;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserTaskable extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['gravatar'];

    /**
     * Get gravatar link url
     *
     * @return string
     */
    public function getGravatarAttribute()
    {
        return Gravatar::get($this->email, 'small');
    }

    /**
     * Get the project relationship
     *
     * @return [type] [description]
     */
    public function project()
    {
        return $this
            ->belongsToMany(Project::class, 'user_project')
            ->withPivot('type');
    }
}
