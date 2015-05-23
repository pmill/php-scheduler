<?php
namespace pmill\Scheduler;

use \pmill\Scheduler\Interfaces\Task as TaskInterface;

class TaskList
{

    /**
     * @var array|Interfaces\Task[]
     */
    protected $tasks = array();

    /**
     * @var array
     */
    protected $output = array();

    /**
    * Adds a new task to the list
    * @param Interfaces\Task $task
    * @return TaskList $this
    */
    public function addTask(Interfaces\Task $task)
    {
        $this->tasks[] = $task;
        return $this;
    }

    /**
     * @param array|Interfaces\Task[] $tasks
     */
    public function setTasks($tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * @return array|Interfaces\Task[]
     */
    public function getTasks()
    {
        return $this->tasks;
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
    * @return array
    */
    public function run()
    {
        foreach ($this->tasks AS $task) {
            if ($task->isDue()) {
                $result = $task->run();
                $this->output[] = array(
                    'task'=>get_class($task),
                    'result'=>$result,
                    'output'=>$task->getOutput(),
                );
            }
        }
        return $this->output;
    }
}