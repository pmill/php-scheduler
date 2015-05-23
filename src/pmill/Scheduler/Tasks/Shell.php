<?php
namespace pmill\Scheduler\Tasks;

class Shell extends Task
{
    /**
     * @var string
     */
    protected $command;

    /**
     * @var array
     */
    protected $arguments = array();

    /**
     * @return mixed
     */
    public function run()
    {
        $output = null;
        exec($this->getCommand().' '.implode(' ', $this->arguments), $output, $result);
             
        $this->setOutput($output);
        return $result;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setCommand($command)
    {
        $this->command = $command;
        return $this;
    }

    /**
     * @return string
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function addArgument($argument)
    {
        $this->arguments[] = $argument;
        return $this;
    }

    /**
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

}