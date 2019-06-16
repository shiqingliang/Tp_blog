<?php
/**
 * Created by PhpStorm.
 * User: rwh
 * Date: 2019/5/4/004
 * Time: 18:59
 */

namespace app\admin\controller;

use app\common\model\Article as ArticleModle;
use app\common\model\Cate as CateModel;

use think\Db;
class Article extends Base
{

    //文章的列表显示
    public function article_lst()
    {
        $where = [];
        $catename = null;
        if (input('?id')){
            $where = [
                'cateId' => input('id'),
            ];
            $catename = model('cate')->where('id',input('id'))->value('catename');
        }

        $article = new ArticleModle();
        $articles = $article->where($where)->with('cate')->order('sort','asc')->paginate('10');
        $this->assign('articles',$articles);
        return $this->fetch();
    }
//文章的添加操作
    public function article_add()
    {
        //实例化model
        $article = new ArticleModle();
        if (request()->isPost()) {
            $data = input('post.');

            $label = implode(',',input('post.label'));
            /*    图片添加方法已经放入Article模型中*/
           /* $file = request()->file('image');
            // 移动到框架应用根目录/public/uploads/ 目录下
            if($file){
                $info = $file->move('./uploads');
                if($info){
                    $pathImg =  "/uploads/" . $info->getSaveName();
                }else{
                    // 上传失败获取错误信息
                    echo $file->getError();
                }
            }
            $data['image_url'] = $pathImg;*/
            $data['label'] =  $label;

            $validate = new \app\common\validate\Article();
            if (!$validate->scene('article_add')->check($data)) {
                $this->error($validate->getError());
            }
            $result = $article->save($data);

            if ($result) {
                $this->success('添加成功！', 'admin/article/article_lst');
            } else {
                $this->error($result);
            }
        }
        $cate = new CateModel();
        $cates = $cate->cateTree();
        $this->assign('cates', $cates);


        return $this->fetch();
    }

//文章的排序操作
    public function article_sort(){
        if (request()->isAjax()){
            $data = input('post.');
            $result = Db::name('article')->where('id',$data['id'])->update(['sort'=>$data['sort']]);
            if ($result){
                $this->success('排序成功！','admin/article/article_lst');
            }else{
                $this->error($result);
            }

        }
    }
//文章的修改操作
    public function article_edit()
    {
        $article = new ArticleModle();
        if (request()->isPost()){
            $data = input('post.');

            $label = implode(',',input('post.label'));

            /*图片的修改已经放入Article模型中*/
          /*  $file = request()->file('image');
            // 移动到框架应用根目录/public/uploads/ 目录下
            if($file){
                $info = $file->move('./uploads');
                if($info){
                    $pathImg =  "/uploads/" . $info->getSaveName();
                }else{
                    // 上传失败获取错误信息
                    echo $file->getError();
                }
            }
            $data['image_url'] = $pathImg;*/
            $data['label'] =  $label;


            $result = $article->save($data,'id',$data['id']);
            if ($result){
                $this->success('修改成功！','admin/article/article_lst');
            }else{
                $this->error($result);
            }
        }

        $cate = new CateModel();
        $cates = $cate->cateTree();
        $articleInfo = $article->find(input('id'));
        $label = $articleInfo['label'];
        $labelInfo = explode(',',$label);


        $this->assign(array(
            'cates' => $cates,
            'articleInfo' => $articleInfo,
            'labelInfo'  => $labelInfo
        ));
        return $this->fetch();



    }
    //文章的删除  删除后文章会进入回收站
    public function article_del()
    {
        if (request()->isAjax()){

            $articleInfo = model('article')->find(input('id'));

            $result = $articleInfo->delete();
//            $result = DB::name('article')->where('id',input('id'))->delete();
            if ($result){
                $this->success('删除成功！','admin/article/article_lst');
            }else{
                $this->error($result);
            }
        }
    }

    //删除文章的回收站首页
    public function article_old(){

        $article = new ArticleModle();

        $articles = $article::onlyTrashed()->paginate('10');
        $this->assign('articles',$articles);
        return $this->fetch();
    }


    //删除文章的还原操作

    public function article_res(){
        if (request()->isAjax()){
            $article = new ArticleModle();
            $articles = $article::onlyTrashed()->find(input('id'));
            $result =  $articles->restore();
            if ($result){
                $this->success('文章还原成功！','admin/article/article_old');
            }else{
                $this->error($result);
            }
        }

    }

//回收站文章的删除
    public function article_old_del(){
        if (request()->isAjax()){
            //找到文章的图片  进行删除
            $articleInfo = Db::name('article')
                ->where('id',input('id'))
                ->find();
            //根据图片的url地址进 对图片进行删除操作
            if ($articleInfo['image_url']){
            //    $articleInfo['image_url'] = str_replace('/','\\',$articleInfo['image_url']);
             //   $articleInfo['image_url'] = '.\\' . $articleInfo['image_url'];
                $articleInfo['image_url'] = $_SERVER['DOCUMENT_ROOT'] . $articleInfo['image_url'];
                @unlink($articleInfo['image_url']);
            }
            //删除文章操作
            $resturn = Db::name('article')
                ->where('id',input('id'))
                ->delete();
            if ($resturn){
                $this->success('文章删除成！','admin/article/article_old');
            }else{
                $this->error($resturn);
            }
        }
    }



//文章的缩略图上传
    public function article_upload()
    {
        // 获取表单上传文件
        /*    if (request()->isPost()) {
                //多图上传
                $arryFile = \request()->file("image");
                $arrImg = [];
                foreach ($arryFile as $File) {
                    $pathImg = "";
                    //移动文件到框架应用更目录的public/uploads/      "public".
                    $info = $File->move(ROOT_PATH . 'public' . DS . 'upload' . DS . 'article' . DS . date('Y') . DS . date('m-d'),md5(microtime(true)));
                    if ($info) {
                            $pathImg =  "/public/upload/article/" . date('Y') . '/' . date('m-d') . '/' . $info->getSaveName();
                    } else {
                        //错误提示用户
                        return $this->error($File->getError());
                    }
                    $arrImg[] = $pathImg;
                }
                $insert_data["img_url"] = implode(",", $arrImg);
            }*/

    }


}



