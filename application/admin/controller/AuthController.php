<?php
/**
 * [KeCms] Copyright (c) 2017 kecms.cn
 * [Author] King east ( 1207877378@qq.com )
 */

namespace app\admin\controller;


use app\admin\model\Admin;
use app\admin\model\AdminLog;
use ke\Controller;
use think\Cookie;
use think\Request;
use think\Validate;

class AuthController extends Controller
{
    /**
     * 登录
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function login(Request $request)
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
            $data->update_time=$_SERVER['REQUEST_TIME'];
            $data->save();

            $request->adminInfo=$data;

            cookie('access',base64_encode(json_encode([
                'token'=>$data->token,
                'id'=>$data->id
            ])),7200);

            AdminLog::write('登录系统');

            $this->success('登录成功','index/index');
        }
        return $this->fetch();
    }

    /**
     * 退出登录
     */
    public function logout()
    {
        Cookie::set('access',null);
        $this->result([]);
    }


    /**
     *
     * @return mixed
     */
    public function pass(Request $request)
    {
        if($this->isPost()){
            $form=getForm();
            $vali=new Validate([
                'pass|密码'=>'require|max:20',
                'newpass|新密码'=>'require|max:20',
                'checkPass|二次密码'=>'require|confirm:newpass'
            ]);
            if(!$vali->check($form)){
                $this->error($vali->getError());
            }
            $admin=Admin::where('id',$request->adminInfo->id)->find();
            if(!$admin){
                $this->error('请重新登录');
            }
            if(!$admin->chkPass($form['pass'])){
                $this->error('原密码验证错误');
            }
            $admin->pass=$form['pass'];
            $admin->token='';
            $admin->save();
            $this->success('密码修改成功，请重新登录');
        }
        $this->assign('data',[
            'user'=>$request->adminInfo->user
        ]);
        return $this->fetch();
    }


    public function errors()
    {
        return $this->fetch();
    }

}