<?php

namespace app\common\model;

use think\Db;
use think\Model;

class Index extends Model
{
    //

    public function index(){
        $systemInfo = DB::name('system')->where('id','1')->find();
       return $this->index($systemInfo);

    }
}
