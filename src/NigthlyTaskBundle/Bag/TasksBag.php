<?php

namespace Dekalee\NigthlyTaskBundle\Bag;

use Symfony\Component\Console\Command\Command;

/**
 * Class TasksBag
 */
class TasksBag
{
    protected $tasks = [];

    /**
     * @param Command $task
     * @param int     $priority
     */
    public function addTask(Command $task, $priority)
    {
        if (!array_key_exists($priority, $this->tasks)) {
            $this->tasks[$priority] = [];
        }
        $this->tasks[$priority][] = $task;
    }

    /**
     * @return array
     */
    public function getTasks()
    {
        krsort($this->tasks, SORT_NUMERIC);

        return $this->tasks;
    }
}
