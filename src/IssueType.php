<?php

namespace Story\Tasking;

use Story\Tasking\Exceptions\InvalidPropertyException;

class IssueType
{
    const STORY = 1;
    const BUG = 2;
    const EPIC = 3;
    const TASK = 4;
    const SUBTASK = 5;

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
        public function __construct(int $id = self::STORY)
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
                'name' => $this->getName($id),
                'description' => $this->getDescription($id)
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
                case 1 : return 'Story'; break;
                case 2 : return 'Epic'; break;
                case 3 : return 'Bug'; break;
                case 4 : return 'Task'; break;
                case 5 : return 'Sub Task'; break;
            }
        }

        /**
         * Get the payload description
         *
         * @param int $id
         * @return void
         */
        protected function getDescription($id)
        {
            switch ($id) {
                case 1 : return 'A user story.'; break;
                case 2 : return 'A big user story that needs to be broken down.'; break;
                case 3 : return 'A problem which impairs or prevents the functions of the product.'; break;
                case 4 : return 'A task that needs to be done.'; break;
                case 5 : return 'The sub-task of the issue.'; break;
            }
        }
}
