<?php
namespace pmill\Scheduler\Interfaces;

interface Task
{
    public function run();
    public function getExpression();
    public function getOutput();
    public function isDue();   
}
