<?php

namespace app\common\validate;

use think\Validate;

class CateValidate extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
	    'catename|栏目名称' => 'require|unique:cate',
        'sort|排序'        => 'require|number|length:1,3',
        'pid|上级栏目'      => 'require',
        'url|控制器'       =>  'require',
        'type|类型'       =>  'require',
        'desc|描述'       =>  'require',
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [];


    protected $scene = [
      'cate_add' => ['catename','url','desc'],
    ];
}
