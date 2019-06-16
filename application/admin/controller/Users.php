<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;

class Users extends Controller
{
    //

    public function users_lst(){

        return $this->fetch();
    }



    public function users_add(){

        return $this->fetch();

    }


    public function users_edit(){

        return $this->fetch();
    }


    public function users_del(){

        return $this->fetch();
    }
}
