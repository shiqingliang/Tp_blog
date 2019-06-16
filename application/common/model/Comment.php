<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Comment extends Model
{
    //
    use SoftDelete;

    //关联模型  文章和 评论关联
    public function Article(){
        return $this->belongsTo('Article', 'article_id', 'id');
    }


}
