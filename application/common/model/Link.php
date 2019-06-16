<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Link extends Model
{
    //软删除
    use SoftDelete;
    protected static function init(){
        //链接的图片
        Link::event('before_insert',function($link){
           if ($_FILES['image']['tmp_name']){
               $file = request()->file('image');
               $info = $file->move('./uploads');
               if ($info){
                   $pathImg = "/uploads/" . $info->getSaveName();
                   $link['image_url'] = $pathImg;
               }
           }
        });
        //链接图片的修改
        Link::event('before_update',function ($link){
           if ($_FILES['image']['tmp_name']){
               $urlInfo = Link::find($link->id);
               $url = $_SERVER['DOCUMENT_ROOT'] . $urlInfo['image_url'];
               if (file_exists($url)){
                   @unlink($url);
               }
               $file = request()->file('image');
               $info = $file->move('./uploads');
               if ($info){
                   $pathImg = "/uploads/" . $info->getSaveName();
                   $link['image_url'] = $pathImg;
               }
           }
        });


    }
}
