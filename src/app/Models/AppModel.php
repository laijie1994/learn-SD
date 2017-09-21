<?php
/**
 * Created by PhpStorm.
 * User: zhangjincheng
 * Date: 16-7-15
 * Time: 下午1:44
 */

namespace app\Models;


use Server\CoreBase\Model;

class AppModel extends Model
{
    public function test($max)
    {
        return ["石老师 ".(mt_rand(0,0) + $max)];
    }

    public function dadayi()
    {
        return ["石老师，love u"];
    }

    public function test_coroutine()
    {
        $redisCoroutine = $this->redis_pool->coroutineSend('get', 'test');
        $result = yield $redisCoroutine;
        return [$result];
    }
}