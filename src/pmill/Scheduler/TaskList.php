<?php

namespace pmill\Scheduler;

use pmill\Scheduler\Interfaces\Task as TaskInterface;

class TaskList
{
    /**
     * @var TaskInterface[]
     */
    protected $tasks = [];

    /**
     * @var string[]
     */
    protected $output = [];

    /**
     * Adds a new task to the list
     *
     * @param TaskInterface $task
     * @return TaskList $this
     */
    public function addTask(TaskInterface $task)
    {
        $this->tasks[] = $task;
        return $this;
    }

    /**
     * @param TaskInterface[] $tasks
     */
    public function setTasks($tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * @return TaskInterface[]
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * @return TaskInterface[]
     */
    public function getTasksDue()
    {
        return array_filter($this->tasks, function (TaskInterface $task) {
            return $task->isDue();
        });
    }

    /**
     * @return array
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * Runs any due task, returning an array containing the output from each task
     *
     * @return array
     */
    public function run()
    {
        $this->output = [];

        foreach ($this->getTasksDue() as $task) {
            $result = $task->run();
            $this->output[] = [
                'task' => get_class($task),
                'result' => $result,
                'output' => $task->getOutput(),
            ];
        }

        return $this->output;
    }
}
