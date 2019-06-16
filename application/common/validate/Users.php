<?php

namespace app\common\validate;

use think\Validate;

class Users extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'username|用户账户' => 'require',
        'pwd|用户密码'   => 'require',
        'conpass|确认密码'    => 'require|confirm:pwd',
        'nickname|昵称'       => 'require|unique:users',
        'email|邮箱'          => 'require|email|unique:users'
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
   /* protected $message = [
        'username.require' => '用户名不能为空！',
        'pwd.require' => '用户密码不能为空！',
        'conpass.confirm' => '确认密码和密码不一致！',
        'nickname.unique' => '亲：昵称已经存在了呢！换一个吧！',
        'email.unique'    => '亲：邮箱已存在,不能重复注册哟!'
    ];*/


    protected $scene = [
        //登录验证
        'login'  =>  ['username','pwd'],
        //注册场景验证
        'register' => ['username','pwd','conpass','nickname','email'],
    ];
}
