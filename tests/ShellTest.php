<?php

class ShellTest extends PHPUnit_Framework_TestCase
{

    public function testSetCommand()
    {
        $command = "echo Hello World";
        $shellTask = new \pmill\Scheduler\Tasks\Shell;
        $shellTask->setCommand($command);

        $this->assertEquals($command, $shellTask->getCommand());
    }

    public function testAddArgument()
    {
        $shellTask = new \pmill\Scheduler\Tasks\Shell;
        $shellTask->addArgument('command argument 1');

        $this->assertEquals(array('command argument 1'), $shellTask->getArguments());
    }

    public function testRun()
    {
        $shellTask = new \pmill\Scheduler\Tasks\Shell;
        $shellTask->setCommand("echo Hello World");
        $result = $shellTask->run();

        $this->assertEquals('Hello World', $result);
        $this->assertEquals('Hello World', $shellTask->getOutput());
    }

}