<?php
/**
 * Created by PhpStorm.
 * User: rwh
 * Date: 2019/5/4/004
 * Time: 19:09
 */

namespace app\admin\controller;

use app\common\model\Link as LinkModel;
use think\Db;

class Link extends Base
{
    public function index()
    {
        $link = new LinkModel();

        $links = $link->order('sort','asc')->paginate('10');
        $this->assign('links',$links);

        return $this->fetch();
    }
    public function link_add(){

        if (request()->isPost()){
            $link = new LinkModel();
            $validate = new \app\common\validate\Link();
            if (!$validate->scene('link_add')->check(input('post.'))){
                $this->error($validate->getError());
            }
            $result = $link->save(input('post.'));
            if ($result){
                $this->success('添加成功！','admin/link/index');
            }else{
                $this->error($result);
            }

        }
        return $this->fetch();
    }

    public function link_edit(){
        $link = new LinkModel();
        if (request()->isPost()){

            $result = $link->save(input('post.'),'id',"input('id')");

            if ($result){
                $this->success('修改成功！','admin/link/index');
            }else{
                $this->error($result);
            }
        }
        $linkInfo = $link->find(input('id'));
        $this->assign('linkInfo',$linkInfo);

        return $this->fetch();
    }
    //链接排序
    public function link_sort(){
        if (request()->isAjax()){
            $data = input('post.');
            $result = Db::name('link')
                ->where('id',$data['id'])
                ->update(['sort'=>$data['sort']]);
            if ($result){
                $this->success('排序成功！','admin/link/index');
            }else{
                $this->error($result);
            }
        }
    }
    public function link_del(){
        if (request()->isAjax()){
            $link = new LinkModel();
            $image_url = $link->where('id',input('id'))->value('image_url');
            $url = $_SERVER['DOCUMENT_ROOT'] . $image_url;
            if (file_exists($url)){
                    @unlink($url);
            }
            $result = Db::name('link')->where('id',input('id'))->delete();
            if ($result){
                $this->success('删除成功！','admin/link/index');
            }else{
                $this->error($result);
            }
        }


    }

}