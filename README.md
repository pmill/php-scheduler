php-scheduler
============

Introduction
------------

This package contains a simple PHP cron task scheduler.

Requirements
------------

This library package requires PHP 5.4 or later and a linux operating system.

Installation
------------

Once you've created your task list script open a linux shell add the following line to crontab (crontab -e):

    * * * * * /path/to/your/task/list/script.php
    

Usage
-----

The following example shows how to schedule a HelloDaily task (simple echo example) and a ShellMonday task (running a shell task example).

    class HelloDailyTask extends \pmill\Scheduler\Task\Task
    {
        public function run()
        {
            $this->setOutput('Hello World');
        }
    }
    
    class ShellMondayTask extends \pmill\Scheduler\Task\Shell
    {
        protected $command = "echo Hello Monday";
    }

    $taskList = new \pmill\Scheduler\TaskList;
    
    // Add task to run at 15:04 every day
    $taskList->addTask((new HelloDailyTask)->setExpression(4 15 * * * *));
    
    // Add task to run at 15:04 every Monday
    $taskList->addTask((new ShellMondayTask)->setExpression(4 15 * * * 1));
    
    $taskList->run();
    $output = $taskList->getOutput();


Version History
---------------

0.1.0 (06/02/2015)

*   First public release of php-scheduler.


Copyright
---------

php-scheduler
Copyright (c) 2015 pmill (dev.pmill@gmail.com) 
All rights reserved.
