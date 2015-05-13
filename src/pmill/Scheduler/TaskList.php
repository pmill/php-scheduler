<?php
namespace pmill\Scheduler;

use \pmill\Scheduler\Interfaces\Task as TaskInterface;

class TaskList
{
    protected $tasks = array();
    protected $output = array();

    /**
    * Adds a new task to the list
    * @param TaskInterface $task
    * @return this
    */
    public function addTask(TaskInterface $task)
    {
        $this->tasks[] = $task;
        return $this;
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