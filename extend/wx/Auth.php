<?php
/**
 * [KeCms] Copyright (c) 2017 kecms.cn
 * [Author] King east ( 1207877378@qq.com )
 */

namespace wx;


use ke\Http;
use think\Config;

class Auth
{
    private $config=[];
    private $root='';
    public function __construct()
    {
        $this->config=Config::load(ROOT_PATH.'config/wx.php','wx');
        $this->root=RUNTIME_PATH.'wx/';
        if(!is_dir($this->root)){
            mkdir($this->root,0755,true);
        }
    }

    private function get()
    {
        if(is_file($this->root.'access_token.php')){
            $d=file_get_contents($this->root.'access_token.php');
            $data=unserialize(substr($d,15));
            if($data['expire_time']<=$_SERVER['REQUEST_TIME']){
                return null;
            }
            return $data['token'];
        }else{
            return null;
        }
    }

    private function set($token,$time)
    {
        file_put_contents($this->root.'access_token.php','<?php exit();?>'.serialize(['token'=>$token,'expire_time'=>$time-200]));
    }

    public function accessToken()
    {
        $r=$this->get();
        if($r){
            return $r;
        }else{
            $http=new Http("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->config['appid']}&secret={$this->config['appSecret']}");
            if($http->send()){
                $ret=$http->toArray();
                if(isset($ret['errcode'])){
                    exit($http->error());
                }
                $this->set($ret['access_token'],$_SERVER['REQUEST_TIME']+$ret['expires_in']);
                return $ret['access_token'];
            }else{
                echo $http->error();
                exit;
            }
        }


    }

}