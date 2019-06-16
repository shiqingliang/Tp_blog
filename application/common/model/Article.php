<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Article extends Model
{
    //软删除
    use SoftDelete;
    //关联模型
    public function Cate(){
        return $this->belongsTo('Cate', 'cateId', 'id');
    }
//模型事件
    protected static function init(){
        //文章添加前图片的添加
        Article::event('before_insert',function($article){
            if ($_FILES['image']['tmp_name']){
                $file = request()->file('image');
                $info = $file->move('./uploads');
                if ($info){
                    $pathImg = "/uploads/" . $info->getSaveName();
                    $article['image_url'] = $pathImg;
                }
            }
        });
        //文章修改前图片的相对文章图片的修改
        Article::event('before_update',function($article){
            if ($_FILES['image']['tmp_name']){
                $urlInfo = Article::find($article->id);
                $url = $_SERVER['DOCUMENT_ROOT'] . $urlInfo['image_url'];
                if (file_exists($url)){
                    @unlink($url);
                }
                    $file = request()->file('image');
                    $info = $file->move('./uploads');
                    if ($info){
                        $pathImg = "/uploads/" . $info->getSaveName();
                        $article['image_url'] = $pathImg;
                    }
            }
        });



    }
}
