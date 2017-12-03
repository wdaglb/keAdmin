<?php
/**
 * [KeCms] Copyright (c) 2017 kecms.cn
 * [Author] King east ( 1207877378@qq.com )
 */

namespace app\admin\controller;


use ke\Controller;
use think\Validate;

class AuthController extends Controller
{
    public function login()
    {
        if($this->isPost()){
            $form=getForm();
            $vali=new Validate([
                'user|登录名'=>'require|max:20',
                'pass|密码'=>'require|max:20'
            ]);
            if(!$vali->check($form)){
                $this->error($vali->getError());
            }

        }
        return $this->fetch();
    }

}