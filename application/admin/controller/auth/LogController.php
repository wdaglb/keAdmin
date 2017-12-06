<?php
/**
 * [KeCms] Copyright (c) 2017 kecms.cn
 * [Author] King east ( 1207877378@qq.com )
 */

namespace app\admin\controller\auth;


use ke\Controller;

class LogController extends Controller
{
    public function lists()
    {
        return $this->fetch();
    }

}