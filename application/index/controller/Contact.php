<?php

namespace app\index\controller;



use app\index\controller\Base as SelectController;
use think\Db;

class Contact extends Base
{
    //
    public function index(){


        $data = new SelectController();
        $datas = $data->select();
        $this->assign('datas',$datas);
        return $this->fetch();
    }
}
