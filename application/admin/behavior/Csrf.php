<?php
/**
 * [KeCms] Copyright (c) 2017 kecms.cn
 * [Author] King east ( 1207877378@qq.com )
 */

namespace app\admin\behavior;



use ke\Controller;
use ke\Glo;

class Csrf extends Controller
{

    public function run($request)
    {
        if($request->isPost()){
            if(empty($_SERVER['HTTP_X_XSRF_TOKEN'])){
                $this->error('Unlawful token');
            }
            $token=$_SERVER['HTTP_X_XSRF_TOKEN'];
            $chk=session('csrf_token');
            if(empty($token) || $token!=$chk){
                $this->error('Unlawful token' . $token);
            }
        }else{
            $token=strtoupper(md5(uniqid(session_id())));
            session('csrf_token',$token);
            setcookie('XSRF-TOKEN',$token);

            Glo::set('csrf_token',$token);
        }

    }

}