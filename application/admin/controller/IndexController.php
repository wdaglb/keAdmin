<?php
/**
 * [KeCms] Copyright (c) 2017 kecms.cn
 * [Author] King east ( 1207877378@qq.com )
 */

namespace app\admin\controller;


use ke\Controller;
use think\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $this->assign('data',[
            'admin'=>$request->adminInfo
        ]);

        return $this->fetch();
    }

}