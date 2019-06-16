<?php
/**
 * Created by PhpStorm.
 * User: rwh
 * Date: 2019/5/13/013
 * Time: 20:40
 */

namespace app\admin\controller;

use app\common\model\Cate as CateModel;
use think\Db;


class Cate extends Base
{
    //前置操作
    protected $beforeActionList = [
        'delsoncate' => ['only'=>'cate_del']

    ];
    //栏目的列表
    public function cate_lst(){
        //无限极分类排序
        $cate = new CateModel();
        $cates = $cate->cateTree();
        $this->assign('cates',$cates);

        return $this->fetch();
    }
    //栏目的添加
    public function cate_add(){

        if (request()->isPost()){
            $data = input('post.');
            $validate = new \app\common\validate\CateValidate();
            if (!$validate->scene('cate_add')->check($data)){
               $this->error($validate->getError());
            }
         $result = model('cate')->save($data);

         if ($result){
             $this->success('添加成功！','admin/cate/cate_lst');
         }else{
             $this->error($result);
         }
        }

        $cate = new CateModel();
        $cates = $cate->cateTree();
        $this->assign('cates',$cates);

        return $this->fetch();
    }


    public function cate_edit(){
        //实列化一个模型
        $cate = new CateModel();
        if (request()->isPost()){
            $result = $cate->save(input('post.'),'id','input("id")');
            if ($result){
                $this->success('修改成功！','admin/cate/cate_lst');
            }else{
                $this->error($result);
            }
        }
        //根据url传递过来的id  进行前台渲染
        $cateinfo = $cate->find(input('id'));
        //调用无限极分类
        $cates = $cate->cateTree();


        $this->assign(array(
            'cates' => $cates,
            'cateinfo' => $cateinfo
        ));

        return $this->fetch();
    }

public function cate_del(){

        if (request()->isAjax()){
            $result = Db::name('cate')->where('id',input('id'))->delete();

            if ($result){
                $this->success('删除成功！','admin/cate/cate_lst');
            }else{
                $this->error($result);
            }
        }
}

//前置删除操作
public function delsoncate(){
        //当前要删除栏目的id
        $cateid = input('id');
        $cate = new CateModel();
        $sonids = $cate->getchilreid($cateid);
        if ( $sonids){
            Db::name('cate')->delete($sonids);
        }
}

}