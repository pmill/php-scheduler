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
    
    class HelloDailyTask extends \pmill\Scheduler\Task\Shell
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


Copyright and License
---------------------

php-scheduler
Copyright (c) 2013 pmill (dev.pmill@gmail.com) 
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are
met:

*   Redistributions of source code must retain the above copyright 
    notice, this list of conditions and the following disclaimer.

*   Redistributions in binary form must reproduce the above copyright
    notice, this list of conditions and the following disclaimer in the
    documentation and/or other materials provided with the 
    distribution.

This software is provided by the copyright holders and contributors "as
is" and any express or implied warranties, including, but not limited
to, the implied warranties of merchantability and fitness for a
particular purpose are disclaimed. In no event shall the copyright owner
or contributors be liable for any direct, indirect, incidental, special,
exemplary, or consequential damages (including, but not limited to,
procurement of substitute goods or services; loss of use, data, or
profits; or business interruption) however caused and on any theory of
liability, whether in contract, strict liability, or tort (including
negligence or otherwise) arising in any way out of the use of this
software, even if advised of the possibility of such damage.
