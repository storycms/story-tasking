<?php

namespace Story\Tasking;

use Story\Tasking\Exceptions\InvalidPropertyException;

class IssuePriority
{
    const HIGHEST = 1;
    const HIGHT = 2;
    const MEDIUM = 3;
    const LOW = 4;
    const LOWEST = 5;

    /**
     * The issue property payload
     *
     * @var IssuePriority
     */
    public $payload;

    /**
     * Create new issue priority instance
     *
     * @param int $id
     */
    public function __construct(int $id = self::MEDIUM)
    {
        $this->set($id);
    }

    /**
     * Set payload data
     *
     * @param int $id
     * @return void
     */
    protected function set($id)
    {
        if (!in_array($id, [1, 2, 3, 4, 5])) {
            throw new InvalidPropertyException;
        }

        $this->payload = (Object) [
            'id' => $id,
            'name' => $this->getName($id)
        ];
    }

    /**
     * Get the payload name
     *
     * @param int $id
     * @return void
     */
    protected function getName($id)
    {
        switch ($id) {
            case 1 : return 'Highest'; break;
            case 2 : return 'Hight'; break;
            case 3 : return 'Medium'; break;
            case 4 : return 'Low'; break;
            case 5 : return 'Lowest'; break;
        }
    }
}
