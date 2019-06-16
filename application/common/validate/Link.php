<?php

namespace app\common\validate;

use think\Validate;

class Link extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
	    'linkname|链接名称' => 'require|unique:link',
        'url|链接地址' => 'require|url',
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [];

    protected $scene = [
      'link_add' => ['linkname','url'],
    ];
}
