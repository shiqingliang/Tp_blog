<?php
/**
 * Created by PhpStorm.
 * User: rwh
 * Date: 2019/5/4/004
 * Time: 20:03
 */

namespace app\admin\controller;


class Admins extends Base
{
    public function admin_info()
    {

        return $this->fetch();
    }
}