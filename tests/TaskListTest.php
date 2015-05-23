<?php

class TaskListTest extends PHPUnit_Framework_TestCase
{

    public function testAddTask()
    {
        /** @var \pmill\Scheduler\Tasks\Task $stubTask */
        $stubTask = $this->getMockForAbstractClass('\pmill\Scheduler\Tasks\Task');
        $stubTask->expects($this->any())
            ->method('run')
            ->will($this->returnValue('task 1'));

        $taskList = new \pmill\Scheduler\TaskList;
        $taskList->addTask($stubTask);

        $this->assertContains($stubTask, $taskList->getTasks());
    }

    public function testSetTasks()
    {
        /** @var \pmill\Scheduler\Tasks\Task $stubTask1 */
        $stubTask1 = $this->getMockForAbstractClass('\pmill\Scheduler\Tasks\Task');
        $stubTask1->expects($this->any())
            ->method('run')
            ->will($this->returnValue('task 1'));

        /** @var \pmill\Scheduler\Tasks\Task $stubTask2 */
        $stubTask2 = $this->getMockForAbstractClass('\pmill\Scheduler\Tasks\Task');
        $stubTask2->expects($this->any())
            ->method('run')
            ->will($this->returnValue('task 2'));

        $taskList = new \pmill\Scheduler\TaskList;
        $taskList->setTasks(array($stubTask1, $stubTask2));

        $this->assertContains($stubTask1, $taskList->getTasks());
        $this->assertContains($stubTask2, $taskList->getTasks());
    }

    public function testRun()
    {
        $stubTask1 = $this->getMock('\pmill\Scheduler\Tasks\Task');
        $stubTask1->expects($this->any())->method('run')->will($this->returnValue('result 1'));
        $stubTask1->expects($this->any())->method('getOutput')->will($this->returnValue('output 1'));
        $stubTask1->expects($this->any())->method('isDue')->will($this->returnValue(true));

        $stubTask2 = $this->getMock('\pmill\Scheduler\Tasks\Task');
        $stubTask2->expects($this->any())->method('run')->will($this->returnValue('result 2'));
        $stubTask2->expects($this->any())->method('getOutput')->will($this->returnValue('output 2'));
        $stubTask2->expects($this->any())->method('isDue')->will($this->returnValue(true));

        $taskList = new \pmill\Scheduler\TaskList;
        $taskList->setTasks(array($stubTask1, $stubTask2));
        $taskList->run();

        $output = $taskList->getOutput();

        $this->assertCount(2, $output);
        $this->assertEquals('output 1', $output[0]['output']);
        $this->assertEquals('output 2', $output[1]['output']);
    }

}