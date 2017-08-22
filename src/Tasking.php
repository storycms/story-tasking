<?php

namespace Story\Tasking;

use Closure;

class Tasking
{
    /**
     * The callback that should be used to authenticate Horizon users.
     *
     * @var \Closure
     */
    public static $authUsing;

    /**
     * Set the callback that should be used to authenticate Horizon users.
     *
     * @param  \Closure  $callback
     * @return static
     */
    public static function auth(Closure $callback)
    {
        static::$authUsing = $callback;

        return new static;
    }
}
