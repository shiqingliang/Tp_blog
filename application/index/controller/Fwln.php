<?php

namespace app\index\controller;

use \app\index\controller\Base as SelectController;
use think\Db;

class Fwln extends Base
{
    //
    public function index(){

        $data = new SelectController();
        $datas = $data->select();
        $fwlnInfo = Db::name('article')->where('cateId','62')->find();
        $this->assign(array(
            'datas'=> $datas,
            'fwlnInfo' => $fwlnInfo
        ));
        return $this->fetch();
    }
}
