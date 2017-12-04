<?php
/**
 * [KeCms] Copyright (c) 2017 kecms.cn
 * [Author] King east ( 1207877378@qq.com )
 */

namespace app\admin\controller;


use ke\Controller;

class IndexController extends Controller
{
    public function index()
    {

        return $this->fetch();
    }

}