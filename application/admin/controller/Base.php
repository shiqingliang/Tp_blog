<?php
/**
 * Created by PhpStorm.
 * User: rwh
 * Date: 2019/5/4/004
 * Time: 18:37
 */

namespace app\admin\controller;

use think\Controller;

class Base extends Controller
{
        //全局自动加载
    protected function initialize()
    {if(!session('?users.username')){
        $this->redirect('admin/login/index');
    }
    }

/*    public function _initialize(){
        if(session('?users.id')){
            $this->redirect('admin/index/index');
        }
    }*/


}