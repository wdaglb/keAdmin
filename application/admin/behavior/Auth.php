<?php
/**
 * [KeCms] Copyright (c) 2017 kecms.cn
 * [Author] King east ( 1207877378@qq.com )
 */

namespace app\admin\behavior;


use app\admin\model\Admin;
use ke\Controller;
use ke\Glo;

class Auth extends Controller
{
    // 不验证授权的路由
    private $noRed=[
        'Auth/login'
    ];

    private function toLogin()
    {
        $this->redirect('auth/login');

    }

    public function run($request)
    {
        $control=$request->controller() . '/' . $request->action();
        if(!in_array($control,$this->noRed)){
            $data=cookie('access');
            if($data){
                $access=json_decode(base64_decode($data));
                if($access){
                    $data=Admin::where('id',$access->id)->find();
                    if($data){
                        Glo::set('adminInfo',$data);

                        $request->adminInfo=$data;
                        return $data;
                    }
                }
            }
            $this->toLogin();

        }
    }

}