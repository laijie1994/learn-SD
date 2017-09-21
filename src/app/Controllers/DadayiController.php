<?php
/**
 * Created by PhpStorm.
 * User: vip
 * Date: 2017/9/1
 * Time: 16:17
 */

namespace app\Controllers;

use app\Models\DadayiModel;
use Server\CoreBase\Controller;

class DadayiController extends Controller
{
    /**
     * @var DadayiModel
     */
    public $DadayiModel;

    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
        $this->DadayiModel = $this->loader->model("DadayiModel",$this);
    }

    public function http_test()
    {
        $res = $this->DadayiModel->getRedisData();
        $this->http_output->end($res);
    }
}