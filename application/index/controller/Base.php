<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
class Base extends Controller
{
    //
    public function select(){
        $systemInfo = DB::name('system')->where('id','1')->find();
        $cates = Db::name('cate')->where('pid','0')->order('id','asc')->select();
        $link = Db::name('link')->select();

        return  $this->assign(array(
            'systemInfo' => $systemInfo,
            'link' => $link,
            'cates' => $cates,
        ));
    }

}
