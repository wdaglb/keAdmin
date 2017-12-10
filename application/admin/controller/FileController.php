<?php
/**
 * [KeCms] Copyright (c) 2017 kecms.cn
 * [Author] King east ( 1207877378@qq.com )
 */

namespace app\admin\controller;


use app\common\model\File;
use ke\Controller;
use ke\FileAction;

class FileController extends Controller
{
    public function lists()
    {
        if($this->isAjax()){
            $page=input('get.page',1,'intval');
            $size=input('get.size',20,'intval');
            $start=($page-1)*$size;

            $where=function($rs){
                $search=[
                    'key'=>input('get.key','','urldecode'),
                    'status'=>input('get.status',0,'intval'),
                    'date'=>input('get.date'),
                ];
                if($search['key']!=''){
                    $rs->where(function($rs) use($search){
                        $rs->where('id',$search['key'])->whereOr('names',$search['key']);
                    });
                }
                if($search['status']!=-1){
                    $rs->where('use',$search['status']);
                }
                if($search['date']!=''){
                    list($startDate,$endDate)=explode(',',$search['date']);
                    $startTime=strtotime(date('Y-m-d 00:00:00',strtotime($startDate)));
                    $endTime=strtotime(date('Y-m-d 23:59:59',strtotime($endDate)));
                    $rs->where('upload_time','>=',$startTime)->where('upload_time','<=',$endTime);
                }
            };

            $list=File::where($where)->order('upload_time','desc')->limit($start,$size)->select();
            $total=File::where($where)->count();

            $this->result(['list'=>$list,'total'=>$total]);
        }
        return $this->fetch();
    }

    /**
     * 删除
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function delete()
    {
        $id=getForm('id');
        if(empty($id)){
            $this->error('参数错误');
        }
        $data=File::where('id',$id)->find();
        if(!$data){
            $this->error('文件不存在或已经删除');
        }
        FileAction::remove(RUNTIME_PATH.$data->src);
        $data->delete();
        $this->success('删除成功');
    }

}