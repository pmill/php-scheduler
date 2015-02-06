<?php
namespace pmill\Scheduler\Tasks;

use \pmill\Scheduler\Interfaces\Task as TaskInterface;

abstract class Task implements TaskInterface
{
    protected $expression = null;
    protected $output = null;
    
    abstract public function run();
    
    /**
    * Sets a cron expression
    * @param string $expression
    * @return this
    */
    public function setExpression($expression)
    {
        $this->expression = $expression;
        return $this;
    }
    
    /**
    * Gets the current cron expression
    * @return string
    */
    public function getExpression()
    {
        return $this->expression;
    }
    
    /**
    * Sets the output from the task
    * @param string $output
    * @return this
    */
    public function setOutput($output)
    {
        $this->output = $output;
        return $this;
    }
    
    /**
    * Gets the output from the task
    * @return string
    */
    public function getOutput()
    {
        return $this->output;
    }
    
    /**
    * Checks whether the task is currently due
    * @return this
    */
    public function isDue()
    {
        $expression = $this->getExpression();
        if (!$expression) {
            return false;
        }
        
        $cron = \Cron\CronExpression::factory($expression);
        return $cron->isDue();
    }
    
}