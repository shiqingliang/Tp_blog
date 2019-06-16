<?php

namespace app\common\model;
use think\Db;
use think\Model;
use think\model\concern\SoftDelete;

class Cate extends Model
{
    //
    use SoftDelete;

    //关联模型


//无限极分类
    public function  cateTree(){
        $cateres= Db::name('cate')->select();
        return $this->sort($cateres);

    }
    public function sort($data,$pid=0,$level=0){
        static $arr = [];
        foreach ($data as $k => $v) {
            if ($v['pid'] == $pid){
                $v['level']=$level;
                $arr[]= $v;
                unset($data[$k]);
                $this->sort($data,$v['id'],$level+1);
            }
        }
        return $arr;
    }


    public function getchilreid($cateid){

        $cates = $this->select();
        return $this->_getchilreid($cates,$cateid);
    }


    public function _getchilreid($cates,$cateid){
    static $arr = [];

    foreach ($cates as $k => $v){
        if ($v['pid'] == $cateid){
            $arr[] = $v['id'];
            $this->_getchilreid($cates,$v['id']);
        }
    }

    return $arr;
    }

}
