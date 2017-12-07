<?php
// +----------------------------------------------------------------------
// | Name: keAdmin
// | Author King east To 1207877378@qq.com
// +----------------------------------------------------------------------

namespace app\admin\controller;


use app\admin\model\AdminLog;
use app\common\model\Users;
use app\common\model\UsersFinance;
use ke\Controller;
use think\Request;
use think\Validate;

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

            $this->result(['list'=>$list,'total'=>$total]);
        }
        return $this->fetch();
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
        $id=input('get.id',0);
        if(empty($id)){
            $this->error('会员不存在');
        }
        $data=Users::where('id',$id)->field('pass,token,private',true)->find();
        if(!$data){
            $this->error('会员不存在');
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
            'user|会员账号'=>'require|max:20',
            'nick|会员昵称'=>'require|max:20',
            'group_id|会员组'=>'require|number'
        ]);
        if(!$data){
            $vali->rule('pass|登录密码','require|max:20');
        }else{
            $vali->rule('pass|登录密码','max:20');
        }
        if(!$vali->check($form)){
            $this->error($vali->getError());
        }
        $rs=Users::where('user',$form['user']);
        if(!$create){
            $rs->where('user','<>',$data->user);
        }
        if($rs->value('id')){
            $this->error("会员账号“{$form['name']}”已经存在");
        }
        $rs=Users::where('nick',$form['nick']);
        if(!$create){
            $rs->where('nick','<>',$data->nick);
        }
        if($rs->value('id')){
            $this->error("会员昵称“{$form['nick']}”已经存在");
        }
        if($create){
            $data=new Users();
        }
        $data->user=$form['user'];
        $data->nick=$form['nick'];
        $data->group_id=$form['group_id'];
        if(isset($form['pass']) && $form['pass']!=''){
            $data->pass=$form['pass'];
        }
        $data->integral=empty($form['integral']) ? 0 : $form['integral'];
        if($create){
            $data->money=empty($form['money']) ? 0 : $form['money'];
            $data->status=empty($form['status']) ? 0 : $form['status'];
        }
        $data->sex=empty($form['sex']) ? 0 : $form['sex'];
        $data->age=empty($form['age']) ? 0 : $form['age'];
        if($create){
            $data->create_time=$_SERVER['REQUEST_TIME'];
        }
        $data->save();
        $id=empty($data->id) ? $data->insertGetId() : $data->id;
        AdminLog::write('修改会员ID：'.$id);
        $this->result(['id'=>$id]);
    }

    /**
     * 充值金额
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function money(Request $request)
    {
        $form=getForm();
        $vali=new Validate([
            'id'=>'require|number',
            'value|充值金额'=>'require|number'
        ]);
        if(!$vali->check($form)){
            $this->error($vali->getError());
        }
        $user=Users::where('id',$form['id'])->find();
        if(!$user){
            $this->error('用户不存在');
        }
        $user->money=$user->money+$form['value'];
        $user->save();
        UsersFinance::write($form['id'],$form['value'],[
            'action_id'=>$request->adminInfo->id
        ]);
        $this->success('充值成功');
    }

    /**
     * 充值积分
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function integral(Request $request)
    {
        $form=getForm();
        $vali=new Validate([
            'id'=>'require|number',
            'value|充值数值'=>'require|number'
        ]);
        if(!$vali->check($form)){
            $this->error($vali->getError());
        }
        $user=Users::where('id',$form['id'])->find();
        if(!$user){
            $this->error('用户不存在');
        }
        $user->integral=$user->integral+$form['value'];
        $user->save();
        UsersFinance::write($form['id'],$form['value'],[
            'action_id'=>$request->adminInfo->id,
            'type'=>1
        ]);
        $this->success('充值成功');
    }

}