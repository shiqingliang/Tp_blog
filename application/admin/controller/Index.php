<?php
/**
 * Created by PhpStorm.
 * User: rwh
 * Date: 2019/5/4/004
 * Time: 18:37
 */

namespace app\admin\controller;


use think\Db;

class Index extends Base
{



    public function index()
    {

        return $this->fetch();

    }
    public function welcome()
    {

        //文章数
        $articles = Db::name('article')->count();
        //用户数
        $users = Db::name('users')->count();

        $this->assign(array(
            'articles' => $articles,
            'users' => $users,
        ));
        return $this->fetch();
    }
}