<?php

use think\Route;

Route::get('attachment',function(){
    set_time_limit(0);
    if(isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])){
        header('Last-Modified: '.$_SERVER['HTTP_IF_MODIFIED_SINCE'],true,304);
        exit;
    }
    $id=input('get.id');
    if(empty($id)){
        header('Status: 301 ID empty');
        exit;
    }
    $data=\app\common\model\File::where('id',$id)->field('id,src,mime,names,use')->find();
    if(!$data){
        header('Status: 410 File Not Found');
        exit;
    }
    if(!is_file(UPLOAD_PATH.$data->src)){
        header('Status: 410 File Is Delete');
        exit;
    }
    $fs=fopen(UPLOAD_PATH.$data->src,'r');
    if(strpos($data->mime,'image')!==false){
        header("Cache-Control: private, max-age=10800, pre-check=10800");
        header("Pragma: private");
        header("Expires: " . date(DATE_RFC822,strtotime("+30 day")));
        header('Content-type:'.$data->mime);
    }else{
        header('Content-type:application/octet-stream');
    }
    Header('Accept-Length: '.filesize(UPLOAD_PATH.$data->src));
    header('Content-Disposition: attachment; filename='.$data->names);
    while (!feof($fs)){
        echo fread($fs,4096);
    }
    fclose($fs);
},['ext'=>'']);