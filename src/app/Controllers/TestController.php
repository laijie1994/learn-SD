<?php

namespace app\Controllers;

use app\Models\TestModel;
use app\Tasks\TestTask;
use Server\CoreBase\Controller;

/**
 * test 控制器测试类
 * User: 赖杰
 * Date: 2017/9/1
 * Time: 14:37
 */
class TestController extends Controller
{
    /**
     * @var TestModel
     */
    public $TestModel;

    /**
     * @var TestTask
     */
    public $TestTask;

    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
        $this->TestModel = $this->loader->model("TestModel", $this);
        $this->TestTask = $this->loader->task("TestTask", $this);
    }

    public function http_test()
    {
        $result = yield $this->TestModel->getRedisData();
        var_dump($result);
        $this->http_output->end($result);
    }

    public function http_task()
    {
        $this->TestTask->testTask();
        $this->TestTask->startTask(1, function ($serv, $task_id, $data) {
            $this->http_output->end($data);
        });
        //协程模式
        $result = yield $this->TestTask->coroutineSend();
    }

    /**
     * html测试
     * server::error_404 是指Server/Views下的error_404.php文件
     * app::error_404 是指app/Views下的error_404.php文件
     */
    public function http_html_test()
    {
        $template = $this->loader->view('server::error_404');
        $this->http_output->end($template->render(['controller' => 'TestController\html_test', 'message' => '页面不存在！']));
    }

    /**
     * mysql 测试
     */
    public function http_mysql_test()
    {
        /*yield $this->mysql_pool->dbQueryBuilder->coroutineSend(null, "
            CREATE TABLE IF NOT EXISTS `MysqlTest` (
              `peopleid` smallint(6) NOT NULL AUTO_INCREMENT,
              `firstname` char(50) NOT NULL,
              `lastname` char(50) NOT NULL,
              `age` smallint(6) NOT NULL,
              `townid` smallint(6) NOT NULL,
              PRIMARY KEY (`peopleid`),
              UNIQUE KEY `unique_fname_lname`(`firstname`,`lastname`),
              KEY `fname_lname_age` (`firstname`,`lastname`,`age`)
            ) ;
        ");*/
        $value = yield $this->mysql_pool->dbQueryBuilder->insert('MysqlTest')
            ->option('HIGH_PRIORITY')
            ->set('firstname', 'White')
            ->set('lastname', 'Cat')
            ->set('age', '25')
            ->set('townid', '10000')->coroutineSend()->dump();
        $value = $this->mysql_pool->dbQueryBuilder->insertInto('account')->intoColumns(['uid', 'static'])->intoValues([[36, 0], [37, 0]])->getStatement(true);
        echo PHP_EOL;
        print_r($value);
        echo PHP_EOL;
        $this->mysql_pool->dbQueryBuilder->select('*')->from('eo_user')->where('userID', 1);
        $this->mysql_pool->query(function ($result) {
            print_r($result);
        });
        $this->destroy();
    }

}