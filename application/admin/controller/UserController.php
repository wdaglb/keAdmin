<?php
// +----------------------------------------------------------------------
// | Name: keAdmin
// | Author King east To 1207877378@qq.com
// +----------------------------------------------------------------------

namespace app\admin\controller;


use app\common\model\Users;
use ke\Controller;

class UserController extends Controller
{
    public function lists()
    {
        if($this->isAjax()){
            $key=input('get.key','','urldecode');
            $page=input('get.page',1,'intval');
            $size=input('get.size',20,'intval');
            $start=($page-1)*$size;

            $where=null;

            if($key!=''){
                $where=function($rs) use($key){
                    $rs->where('id|user',$key);
                };
            }

            $list=Users::where($where)->limit($start,$size)->select();
            $total=Users::where($where)->count();


            foreach ($list as &$g){
                if(!isset($g->group)){
                    $g['group']='超级管理员';
                }
            }

            $this->result(['list'=>$list,'total'=>$total]);
        }
        return $this->fetch();
    }

}