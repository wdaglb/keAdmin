<?php
// +----------------------------------------------------------------------
// | Name: keAdmin
// | Author King east To 1207877378@qq.com
// +----------------------------------------------------------------------

namespace app\admin\controller\auth;


use app\admin\model\Admin;
use app\admin\model\AdminRole;
use ke\Controller;
use think\Validate;

class ManageController extends Controller
{
    public function lists()
    {
        if($this->isAjax()){
            $key=input('get.key','','urldecode');
            $page=input('get.page',1,'intval');
            $size=input('get.size',20,'intval');
            $start=($page-1)*$size;

            $rs=new Admin;
            $rs->with('groups');
            $where=null;

            if($key!=''){
                $where=function($rs) use($key){
                    $rs->where('id|user',$key);
                };
            }

            $list=Admin::with('groups')->where($where)->limit($start,$size)->select();
            $total=Admin::with('groups')->where($where)->count();


            foreach ($list as &$g){
                if(!isset($g->group)){
                    $g['group']='超级管理员';
                }
            }

            $this->result(['list'=>$list,'total'=>$total]);
        }
        return $this->fetch();
    }
    /**
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function create()
    {
        if($this->isPost()){
            $this->submit();
        }
        $role=AdminRole::select();
        $this->assign('data',[
            'rolelist'=>$role
        ]);
        return $this->fetch('submit');
    }

    public function edit()
    {
        $id=input('get.id',0,'intval');
        if(empty($id)){
            $this->error('管理员不存在');
        }
        $data=Admin::where('id',$id)->field('pass',true)->find();
        if(!$data){
            $this->error("管理员“{$id}”不存在");
        }
        if($this->isPost()){
            $this->submit($data);
        }
        $role=AdminRole::select();
        $this->assign('data',[
            'item'=>$data,
            'rolelist'=>$role
        ]);
        return $this->fetch('submit');
    }


    /**
     * 提交保存数据
     * @param bool $data
     */
    private function submit($data=false)
    {
        $create=!$data;
        $form=getForm();
        $vali=new Validate([
            'user|登录账号'=>'require|max:20',
            'group_id|角色'=>'require|number'
        ]);
        if(!$data){
            $data=new Admin;
            $vali->rule('pass|登录密码','require|max:20');
        }else{
            $vali->rule('pass|登录密码','max:20');
        }
        if(!$vali->check($form)){
            $this->error($vali->getError());
        }
        $rs=Admin::where('user',$form['user']);
        if(!$create){
            $rs->where('user','<>',$form['user']);
        }
        if($rs->value('id')){
            $this->error("账号“{$form['user']}”已存在");
        }

        if($create){
            $data->pass=$form['pass'];
            $data->create_time=$_SERVER['REQUEST_TIME'];
        }else{
            if(isset($form['pass'])){
                $data->token='';
                $data->pass=$form['pass'];
            }
        }
        $data->user=$form['user'];
        $data->group_id=$form['group_id'];
        $data->update_time=$_SERVER['REQUEST_TIME'];
        $data->save();
        $id=empty($data->id) ? $data->insertGetId() : $data->id;
        $this->result(['id'=>$id]);

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
            $this->error("账号“{$id}”不存在");
        }
        $data=Admin::where('id',$id)->find();
        if(!$data){
            $this->error("账号“{$id}”不存在");
        }
        $data->delete();
        $this->result(['id'=>$id]);

    }



}