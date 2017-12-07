<?php
/**
 * [KeCms] Copyright (c) 2017 kecms.cn
 * [Author] King east ( 1207877378@qq.com )
 */

namespace app\admin\controller\auth;


use app\admin\model\AdminLog;
use ke\Controller;
use think\helper\Time;

class LogController extends Controller
{
    public function lists()
    {
        list($start_time,$end_time)=Time::dayToNow(7, true);
        $dates[]=date('Y-m-d',$start_time);
        $dates[]=date('Y-m-d',$end_time);
        if($this->isAjax()){
            $key=input('get.key','','urldecode');
            $page=input('get.page',1,'intval');
            $size=input('get.size',20,'intval');
            $date=input('get.date','','urldecode');
            $start=($page-1)*$size;

            if($date!=''){
                list($start_date,$end_date)=explode(',',$date);
                $start_time=strtotime(date('Y-m-d 00:00:00',strtotime($start_date)));
                $end_time=strtotime(date('Y-m-d 23:59:59',strtotime($end_date)));
            }

            $where=null;


            if($key!=''){
                $where=function($rs) use($key){
                    $rs->where('user_id',$key);
                };
            }
            $d=function($rs) use($start_time,$end_time){
                $rs->where('create_time','>',$start_time)->where('create_time','<',$end_time);
            };

            $list=AdminLog::where($where)->where($d)->order('create_time','desc')->limit($start,$size)->select();
            $total=AdminLog::where($where)->where($d)->count();


            foreach ($list as &$g){
                if(!isset($g->group)){
                    $g['group']='超级管理员';
                }
            }

            $this->result(['list'=>$list,'total'=>$total]);
        }
        $this->assign('data',[
            'date'=>$dates
        ]);
        return $this->fetch();
    }

}