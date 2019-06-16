<?php

namespace app\index\controller;


use app\index\controller\Base as SelectController;
use think\Db;


class Yslx extends Base
{
    //
    public function index(){


        $data = new SelectController();
        $datas = $data->select();
        $this->assign('datas',$datas);
        return $this->fetch();
    }



    public function yslx_tlys(){


        $articles = Db::name('article')->where('cateId','65')->find();
        $data = new SelectController();
        $datas = $data->select();
        $this->assign(array(
            'datas' => $datas,
            'articles' => $articles
        ));
        return $this->fetch();
    }



    public function yslx_ky(){

        $articles = Db::name('article')->where('cateId','66')->find();
        $data = new SelectController();
        $datas = $data->select();
        $this->assign(array(
            'datas' => $datas,
            'articles' => $articles
        ));
        return $this->fetch();
    }


    public function yslx_kcys(){


        $articles = Db::name('article')->where('cateId','68')->find();
        $data = new SelectController();
        $datas = $data->select();
        $this->assign(array(
            'datas' => $datas,
            'articles' => $articles
        ));
        return $this->fetch();

    }
}
