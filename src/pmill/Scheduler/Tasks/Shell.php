<?php
namespace pmill\Scheduler\Tasks;

class Shell extends Task
{
    protected $command = null;
    protected $arguments = array();
    
    public function run()
    {
        $output = null;
        exec($this->getCommand().' '.implode(' ', $this->arguments), $output, $result);
             
        $this->setOutput($output);
        return $result;
    }
        
    public function setCommand($value)
    {
        $this->command = $value;
        return $this;
    }
    
    public function getCommand()
    {
        return $this->command;
    }
    
    public function addArgument($value)
    {
        $this->arguments[] = $value;
        return $this;
    }
}