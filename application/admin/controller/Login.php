<?php

namespace app\admin\controller;

use think\Controller;

use app\common\model\Users as UsersModel;


use think\session;
class Login extends Controller
{
  /*  public function _initialize(){
        if(session('?users.id')){
            $this->redirect('admin/index/index');
        }
    }*/



    //登录操作
    public function index(){

        $users = new UsersModel();

        if (request()->isPost()){
            $data = [
              'username' => input('post.username'),
              'pwd' => md5(input('post.pwd')  ),
            ];

            $result = $users->where($data)->find();


            if ($result){

                $sessionData = [
                    'id' => $result['id'],
                    'username' => $result['username'],
                    'nickname' => $result['nickname'],
                    /*'state'    => $result['state'],*/
                ];

                Session('users',$sessionData);

                $this->success('登录成功！','admin/index/index');
            }else{
                $this->error('用户名/密码错误！','admin/login/index');
            }
        }



        return $this->fetch();
    }



    public function logout(){
        session('users', null);
        $this -> success('注销成功','admin/login/index');
        return $this->fetch();
    }
}
