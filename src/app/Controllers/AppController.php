<?php

namespace app\Controllers;

use app\Models\AppModel;
use Server\CoreBase\Controller;

/**
 * Created by PhpStorm.
 * User: zhangjincheng
 * Date: 16-7-15
 * Time: 下午3:51
 */
class AppController extends Controller
{
    /**
     * @var AppModel
     */
    public $AppModel;

    /**
     * @var AppRedis
     */
    public $AppRedis;

    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
        $this->AppModel = $this->loader->model('AppModel', $this);
        //获取一个异步redis连接池
        $this->AppRedis = get_instance()->getAsynPool("redis2");
    }

    public function http_test()
    {
        $max = $this->http_input->get("max");
        $res = $this->AppModel->test($max);
        $this->http_output->end($res);
    }

    public function http_dadayi()
    {
        $res = $this->AppModel->dadayi();
        var_dump($this->AppRedis);
        $this->http_output->end($res);
    }

    public function http_testCoroutine()
    {
        $result = yield $this->AppModel->test_coroutine();
        $this->http_output->end($result);
    }

    public function http_redis()
    {
        $value = yield $this->redis_pool->getCoroutine()->ping();
        if (!$value) {
            throw new SwooleTestException('redis连接失败');
        }
        $this->http_output->end($value);
    }

}