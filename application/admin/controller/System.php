<?php
/**
 * Created by PhpStorm.
 * User: rwh
 * Date: 2019/5/4/004
 * Time: 20:00
 */

namespace app\admin\controller;

use app\common\model\System as SystemModel;
use think\Db;

class System extends Base
{
    public function index()
    {
        if (request()->isPost()){
            $systems = new SystemModel();
            $result = $systems->save(input('post.'),'id',input('id'));
           if ($result){
               $this->success('修改成功！','admin/system/index');
           }else{
               $this->error($result);
           }
        }

        $system = Db::name('system')->select();

        $this->assign('system',$system);

        return $this->fetch();
    }
}