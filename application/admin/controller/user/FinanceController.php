<?php
/**
 * [KeCms] Copyright (c) 2017 kecms.cn
 * [Author] King east ( 1207877378@qq.com )
 */

namespace app\admin\controller\user;


use app\common\model\UsersFinance;
use ke\Controller;

class FinanceController extends Controller
{
    public function lists()
    {
        if($this->isAjax()){
            $key=input('get.key','','urldecode');
            $page=input('get.page',1,'intval');
            $size=input('get.size',20,'intval');
            $start=($page-1)*$size;

            $where=function($rs){
                $search=[
                    'key'=>input('get.key','','urldecode'),
                    'status'=>input('get.status',-1,'intval'),
                    'types'=>input('get.types',-1,'intval'),
                    'moneyMin'=>input('get.moneyMin',0),
                    'moneyMax'=>input('get.moneyMax',0)
                ];
                if($search['key']!=''){
                    $rs->where('id|user_id',$search['key']);
                }
                if($search['types']!=-1){
                    $rs->where('types',$search['types']);
                }
                if($search['status']!=-1){
                    $rs->where('status',$search['status']);
                }
                if($search['moneyMax']>$search['moneyMin'] && $search['moneyMax']!=0){
                    $rs->where('money','>=',$search['moneyMin'])->where('money','<=',$search['moneyMax']);
                }
            };

            $list=UsersFinance::where($where)->order('create_time','desc')->limit($start,$size)->select();
            $total=UsersFinance::where($where)->count();

            $this->result(['list'=>$list,'total'=>$total]);
        }
        return $this->fetch();
    }
}