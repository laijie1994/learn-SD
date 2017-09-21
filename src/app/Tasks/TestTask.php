<?php
/**
 * Created by PhpStorm.
 * User: vip
 * Date: 2017/9/1
 * Time: 16:49
 */

namespace app\Tasks;


use Server\CoreBase\Task;

class TestTask extends Task
{
    public function testTask()
    {
        return "test task";
    }
}