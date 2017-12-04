<?php
/**
 * [KeCms] Copyright (c) 2017 kecms.cn
 * [Author] King east ( 1207877378@qq.com )
 */

namespace app\admin\controller;


use app\admin\model\Admin;
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
            $data=Admin::where('user',$form['user'])->find();
            if(!$data){
                $this->error("账号“{$form['user']}”不存在");
            }
            if(!$data->chkPass($form['pass'])){
                $this->error('密码错误');
            }
            $data->token=md5(uniqid(rand_letter(8)));
            $data->save();

            cookie('access',base64_encode(json_encode([
                'token'=>$data->token,
                'id'=>$data->id
            ])));

            $this->success('登录成功','index/index');
        }
        return $this->fetch();
    }

}