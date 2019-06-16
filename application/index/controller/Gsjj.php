<?php

namespace app\index\controller;

use app\index\controller\Base as SelectController;
use think\Db;

class Gsjj extends Base
{
    //
    public function index(){


        $gsjjInfo = Db::name('article')->where('cateId','60')->find();
        $data = new SelectController();
        $datas = $data->select();
        $this->assign(array(
            'datas' => $datas,
            'gsjjInfo' => $gsjjInfo,
        ));
        return $this->fetch();
    }
}
