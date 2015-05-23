<?php

class TaskTest extends PHPUnit_Framework_TestCase
{

    public function testSetExpression()
    {
        /** @var \pmill\Scheduler\Tasks\Task $stub */
        $stub = $this->getMockForAbstractClass('\pmill\Scheduler\Tasks\Task');
        $stub->expects($this->any())
            ->method('run')
            ->will($this->returnValue('example output'));

        $stub->setExpression('1 2 3 4 5');
        $this->assertEquals('1 2 3 4 5', $stub->getExpression());
    }

    public function testIsDue()
    {
        /** @var \pmill\Scheduler\Tasks\Task $stub */
        $stub = $this->getMockForAbstractClass('\pmill\Scheduler\Tasks\Task');
        $stub->expects($this->any())
            ->method('run')
            ->will($this->returnValue('example output'));

        $stub->setExpression('* * * * *');
        $this->assertTrue($stub->isDue());

        $stub->setExpression(date('i G').' * * *');
        $this->assertTrue($stub->isDue());

        $stub->setExpression(date('i G', strtotime('-1 minute')).' * * *');
        $this->assertFalse($stub->isDue());
    }

}