<?php

namespace app\admin\controller;

use app\common\model\Comment as commentModel;

class Comment extends Base
{
    //列表
   public function comment_lst(){

       $where = [];
       $title = null;
       if (input('?id')){
           $where = [
               'article_id' => input('id'),
           ];
           $title = model('article')->where('id',input('id'))->value('title');
       }

       $comment = new commentModel();

       $commentInfo = $comment->where($where)->with('article')->paginate('10');


       $this->assign(array(
          'commentInfo' => $commentInfo,
       ));

       return $this->fetch();
   }

   public function comment_see(){


       $comment = new commentModel();

       $comment_see_Info = $comment->find(input('id'));

       $this->assign('comment_see_Info',$comment_see_Info);

       return $this->fetch();
   }
}
