<?php
/**
 * [KeCms] Copyright (c) 2017 kecms.cn
 * [Author] King east ( 1207877378@qq.com )
 */

namespace app\admin\controller;


use app\common\model\File;
use ke\Controller;

class FileController extends Controller
{
    public function lists()
    {
        if($this->isAjax()){
            $page=input('get.page',1,'intval');
            $size=input('get.size',20,'intval');
            $start=($page-1)*$size;

            $where=function($rs){

            };

            $list=File::where($where)->order('upload_time','desc')->limit($start,$size)->select();
            $total=File::where($where)->count();

            $this->result(['list'=>$list,'total'=>$total]);
        }
        return $this->fetch();
    }

}