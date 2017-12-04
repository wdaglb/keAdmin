<?php
/**
 * [KeCms] Copyright (c) 2017 kecms.cn
 * [Author] King east ( 1207877378@qq.com )
 */

namespace ke;

class Ke extends \think\template\TagLib
{

    // 标签定义
    protected $tags = [
        // 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1） alias 标签别名 level 嵌套层次
        'assets'=>['attr'=>'file', 'close' => 0],

        'init'=>['attr'=>'file','close'=>0],
    ];

    public function tagAssets($attr,$content)
    {
        return '//'.$_SERVER['SERVER_NAME'].'/static/<?php echo request()->module();?>/'.$attr['file'];

    }

    public function tagInit($attr,$content)
    {
        if($attr['file']==''){
            $vars='';
        }else{
            $tmp=explode(',',$attr['file']);
            $vars='';
            foreach ($tmp as $item){
                $key=$item;
                $name=$this->autoBuildVar($item);
                $vars.=$key.':<?php echo (is_array('.$name.') ? json_encode('.$name.') : '.$name.');?>,';
            }
            $vars=substr($vars,0,strlen($vars)-1);
        }
        $fs=sprintf('<script>ke.init({%s})</script>',$vars);
        $fs.='<script src="//'.$_SERVER['SERVER_NAME'].'/static/<?php echo request()->module();?>/module/<?php echo str_replace(\'.\',\'/\',strtolower(request()->controller()));?>/<?php echo request()->action();?>.js"></script>';


        return $fs;
    }



}