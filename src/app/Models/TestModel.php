<?php
namespace app\Models;

use Server\CoreBase\Model;
/**
 * test model 测试类
 * User: 赖杰
 * Date: 2017/9/1
 * Time: 14:42
 */

class TestModel extends Model
{
    public function getMysqlData()
    {

    }

    public function getRedisData()
    {
        $this->redis_pool->getCoroutine()->set("name","dadayi");
        $result = yield $this->redis_pool->getCoroutine()->get("name");
        return $result;
    }
}