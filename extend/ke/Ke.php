<?php
/**
 * [KeCms] Copyright (c) 2017 kecms.cn
 * [Author] King east ( 1207877378@qq.com )
 */

namespace ke;

use think\App;

class Ke extends \think\template\TagLib
{

    // 标签定义
    protected $tags = [
        // 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1） alias 标签别名 level 嵌套层次
        'assets'=>['attr'=>'file,module', 'close' => 0],

        'init'=>['attr'=>'var','close'=>0],
        'seturl'=>['attr'=>'name,link,ext','close'=>0],
    ];

    public function tagAssets($attr,$content)
    {
        if(isset($attr['module']) && $attr['module']=='false'){
            return '//'.$_SERVER['SERVER_NAME'].'/static/'.$attr['file'];
        }else{
            return '//'.$_SERVER['SERVER_NAME'].'/static/<?php echo request()->module();?>/'.$attr['file'];
        }
    }

    public function tagSeturl($attr,$content)
    {
        if(strpos($attr['name'],',')===false){
            if(!isset($attr['link'])){
                $attr['link']=$attr['name'];
            }
            if(isset($attr['ext'])) {
                $attr['ext']='\''.$attr['ext'].'\'';
            }else{
                $attr['ext']='\'.\'.config(\'url_html_suffix\')';
            }
            $echo=sprintf('<?php $__K_TO_VUE_URLS[\'%1$s\']=url(\'%2$s\',[],%3$s);?>',$attr['name'],$attr['link'],$attr['ext']);
        }else{
            $li=explode(',',$attr['name']);
            $echo='<?php ';
            foreach ($li as $g){
                $echo.=sprintf('$__K_TO_VUE_URLS[\'%1$s\']=url(\'%2$s\');',$g,(isset($attr['link']) ? $attr['link'] : $link=$g));
            }
            $echo.='?>';
        }
        return $echo;
    }

    public function tagInit($attr,$content)
    {
        $vars='<?php if(isset($__K_TO_VUE_URLS)){echo \'map:\'.json_encode($__K_TO_VUE_URLS);}else{echo \'map:{ }\';}?>';
        if($attr['var']!=''){
            $tmp=explode(',',$attr['var']);
            foreach ($tmp as $item){
                $key=$item;
                $name=$this->autoBuildVar($item);
                $vars.='<?php if(isset('.$name.')):?>';
                $vars.=','.$key.':<?php echo (is_array('.$name.') ? json_encode('.$name.') : '.$name.');?>';
                $vars.='<?php endif;?> ';
            }
        }
        $fs=sprintf('<script>ke.init({%s})</script>',$vars);
        $src='//'.$_SERVER['SERVER_NAME'].'/static/<?php echo request()->module();?>/module/<?php echo config(\'modulejs\');?>.js';
        if(App::$debug){
            $src.='?v=<?php echo $_SERVER[\'REQUEST_TIME\'];?>';
        }

        $fs.="\r\n".'<script src="'.$src.'"></script>';


        return $fs;
    }



}