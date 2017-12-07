<?php
// +----------------------------------------------------------------------
// | Name: keAdmin
// | Author King east To 1207877378@qq.com
// +----------------------------------------------------------------------

namespace app\admin\controller\user;


use app\admin\model\AdminLog;
use app\common\model\Users;
use app\common\model\UsersGroup;
use ke\Controller;
use think\Validate;

class GroupController extends Controller
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
                    $rs->where('name',$key);
                };
            }

            $list=UsersGroup::withCount('users')->where($where)->limit($start,$size)->select();
            $total=UsersGroup::where($where)->count();

            $this->result(['list'=>$list,'total'=>$total]);
        }
        return $this->fetch();
    }

    /**
     * 创建
     * @return mixed
     */
    public function create()
    {
        if($this->isPost()){
            $this->submit();
        }

        return $this->fetch('submit');
    }

    /**
     * 编辑
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function edit()
    {
        $id=input('get.id',0,'intval');
        if(empty($id)){
            $this->error('会员组不存在');
        }
        $data=UsersGroup::where('id',$id)->find();
        if(!$data){
            $this->error('会员组不存在');
        }
        if($this->isPost()){
            $this->submit($data);
        }
        $this->assign('data',[
            'item'=>$data
        ]);
        return $this->fetch('submit');
    }

    /**
     * 保存内容
     * @param bool $data
     */
    private function submit($data=false)
    {
        $create=!$data;
        $form=getForm();
        $vali=new Validate([
            'name|会员组名称'=>'require|max:20',
            'integral|需求积分'=>'require|number'
        ]);
        if(!$vali->check($form)){
            $this->error($vali->getError());
        }
        $rs=UsersGroup::where('name',$form['name']);
        if($data){
            $rs->where('name','<>',$data->name);
        }
        if($rs->value('id')){
            $this->error("会员组名称“{$form['name']}”已经存在");
        }
        if(!$data) $data=new UsersGroup;
        $data->name=$form['name'];
        $data->integral=$form['integral'];
        if($create){
            $data->create_time=$_SERVER['REQUEST_TIME'];
        }
        $data->save();
        $id=empty($data->id) ? $data->insertGetId() : $data->id;
        AdminLog::write('设置会员组ID：'.$id);
        $this->result(['id'=>$id]);
    }

    /**
     * 更新用户会员组数据
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function update()
    {
        $list=Users::where('integral','>',0)->field('id,integral')->select();
        $n=0;
        foreach ($list as $g){
            $group=UsersGroup::field('id,integral')->where('integral','<=',$g->integral)->order('integral','desc')->value('id');
            if($group){
                $g->group_id=$group;
                if($g->save()){
                    $n++;
                }
            }
        }
        if($n){
            $this->result(['num'=>$n]);
        }else{
            $this->error('没有用户需要更新');
        }


    }

}