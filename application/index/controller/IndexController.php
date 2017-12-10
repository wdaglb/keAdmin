<?php
/**
 * [KeCms] Copyright (c) 2017 kecms.cn
 * [Author] King east ( 1207877378@qq.com )
 */

namespace app\index\controller;


use ke\Controller;
use wx\Auth;

class IndexController extends Controller
{
    public function index()
    {
        $a=new Auth();
        $access_token=$a->accessToken();
        var_dump($access_token);exit;
    }

}