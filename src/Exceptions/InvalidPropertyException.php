<?php

namespace Story\Tasking\Exceptions;

use Exception;

class InvalidPropertyException extends Exception
{
    public function __construct($message = 'Invalid property')
    {
        parent::__construct($message);
    }
}
