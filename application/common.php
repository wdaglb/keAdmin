<?php
// 应用公共文件

function csrf_token()
{
    return \ke\Glo::get('csrf_token');
}

function getForm($key='',$val=null)
{
    $content=file_get_contents('php://input');
    $data=json_decode($content,true);
    if($key!=''){
        return isset($data[$key]) ? $data[$key] : $val;
    }else{
        return $data;
    }
}
function rand_letter($length)
{
    $str='abcdefghijklmnopqrstuvwxyz0123456789';
    $max=strlen($str);
    $ret='';

    for($i=0;$i<$length;$i++){
        $ret.=substr($str,mt_rand(1,$max),1);
    }
    return $ret;
}