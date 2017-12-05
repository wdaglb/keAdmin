<?php
/**
 * [KeCms] Copyright (c) 2017 kecms.cn
 * [Author] King east ( 1207877378@qq.com )
 */

namespace app\admin\behavior;


use think\App;
use think\Config;

class ModuleJs
{
    public function run($request)
    {
        $template=$request['template'];
        $path=Config::get('template.view_path');
        if($path){
            $path=str_replace($path,'',$template);
        }else{
            $path=str_replace(App::$modulePath.'view'.DS,'',$template);
        }
        $path=str_replace(['\\','.html'],['/',''],$path);
        Config::set('modulejs',$path);
    }

}