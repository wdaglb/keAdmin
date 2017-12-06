<?php
/**
 * [KeCms] Copyright (c) 2017 kecms.cn
 * [Author] King east ( 1207877378@qq.com )
 */

namespace app\admin\controller\auth;



use app\admin\model\Admin;
use app\admin\model\AdminGroup;
use app\admin\model\AdminRole;
use app\admin\model\AdminRule;
use app\admin\model\AdminRuleAccess;
use ke\Controller;
use think\Validate;

class GroupController extends Controller
{
    public function lists()
    {
        if($this->isAjax()){
            $parent_id=input('get.pid',0);
            $list=AdminGroup::where('parent_id',$parent_id)->select();
            foreach ($list as &$g){
                $g->leaf=$g->leaf;
            }

            $this->result(['list'=>$list]);
        }
        return $this->fetch();
    }

    /**
     * 创建
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
        $pid=input('get.pid',0,'intval');
        if($pid>0){
            $parent=AdminGroup::where('id',$pid)->field('id,name')->find();
            if(!$parent){
                $this->error("分组“ID:{$pid}”不存在");
            }
        }else{
            $parent=['id'=>0,'name'=>'顶级'];
        }
        $this->assign('data',[
            'parent'=>$parent
        ]);
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
            $this->error('分组不存在','lists');
        }
        $data=AdminGroup::where('id',$id)->field('id,parent_id,name,content,valid')->find();
        if(!$data){
            $this->error('分组不存在','lists');
        }
        if($this->isPost()){
            $this->submit($data);
        }


        $pid=$data->parent_id;
        if($pid>0){
            $parent=AdminGroup::where('id',$pid)->field('id,name')->find();
            if(!$parent){
                $this->error("分组“ID:{$pid}”不存在");
            }
        }else{
            $parent=['id'=>0,'name'=>'顶级'];
        }
        $this->assign('data',[
            'item'=>$data,
            'parent'=>$parent
        ]);
        return $this->fetch('submit');
    }

    /**
     * 创建或保存内容
     * @param bool $data
     */
    private function submit($data=false)
    {
        $form=getForm();
        $vali=new Validate([
            'name|用户组名称'=>'require|max:20',
            'content|备注内容'=>'max:255'
        ]);
        if(!$vali->check($form)){
            $this->error($vali->getError());
        }
        $rs=AdminGroup::where('name',$form['name']);
        if($data){
            $rs->where('name','<>',$data->name);
        }
        if($rs->value('id')){
            $this->error("用户组名称“{$form['name']}”已经存在");
        }
        if(!$data) $data=new AdminGroup;
        $data->name=$form['name'];
        $data->parent_id=empty($form['parent_id']) ? 0 : $form['parent_id'];
        $data->content=isset($form['content']) ? $form['content'] : '';
        $data->valid=empty($form['valid']) ? 0 : 1;
        $data->save();
        $id=empty($data->id) ? $data->insertGetId() : $data->id;
        $this->result(['id'=>$id]);

    }

    /**
     * 删除
     */
    public function delete()
    {
        $id=input('post.id',0,'intval');
        if(empty($id)){
            $this->error('分组不存在','lists');
        }
        $data=AdminGroup::where('id',$id)->field('id')->find();
        if(!$data){
            $this->error('分组不存在','lists');
        }
        $data->delete();
        $this->result(['id'=>$id]);

    }

    /**
     * 角色列表
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function listsrole()
    {
        if($this->isAjax()){
            $group_id=input('get.gid',0);
            $list=AdminRole::where('group_id',$group_id)->select();
            foreach ($list as &$g){
                $g->group=AdminRole::where('id',$g->group_id)->value('name');
                if(!$g->group) $g->group='顶级';
            }

            $this->result(['list'=>$list]);
        }
        return $this->fetch();
    }

    /**
     * 创建角色
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function createrole()
    {
        if($this->isPost()){
            $this->submitRole();
        }

        // 分组
        $gid=input('get.gid',0,'intval');
        if($gid>0){
            $parent=AdminGroup::where('id',$gid)->field('id,name')->find();
            if(!$parent){
                $this->error("分组“ID:{$gid}”不存在");
            }
        }else{
            $parent=['id'=>0,'name'=>'顶级'];
        }

        // 读取规则
        $rule=AdminRule::where('parent_id',0)->field('id,name,title,parent_id')->select();
        $rulelist=[];
        foreach ($rule as $g){
            $tmp=collection(AdminRule::where('parent_id',$g->id)->field('id,name,title,parent_id')->select())->toArray();
            $child=[];
            foreach ($tmp as $tmps) {
                $child[$tmps['id']]=$tmps;
            }
            $g['children']=$child;
            unset($child);
            unset($tmp);
            $rulelist[$g['id']]=$g;
        }
        unset($rule);

        $this->assign('data',[
            'parent'=>$parent,
            'rule'=>$rulelist
        ]);
        return $this->fetch('rolepost');
    }

    /**
     * 编辑角色
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function editrole()
    {
        $id=input('get.id',0,'intval');
        if(empty($id)){
            $this->error('分组不存在','lists');
        }
        $data=AdminRole::where('id',$id)->field('id,group_id,name,content')->find();
        if(!$data){
            $this->error('分组不存在','lists');
        }
        if($this->isPost()){
            $this->submitRole($data);
        }
        $data=$data->toArray();
        // 已有规则
        $rl=collection(AdminRuleAccess::where('role_id',$data['id'])->select())->toArray();
        $data['auth']=[];
        foreach ($rl as $g){
            $data['auth'][$g['rule_id']]=true;
        }


        $pid=$data['group_id'];
        if($pid>0){
            $parent=AdminGroup::where('id',$pid)->field('id,name')->find();
            if(!$parent){
                $this->error("分组“ID:{$pid}”不存在");
            }
        }else{
            $parent=['id'=>0,'name'=>'顶级'];
        }
        // 读取规则
        $rule=AdminRule::where('parent_id',0)->field('id,name,title,parent_id')->select();
        $rulelist=[];
        foreach ($rule as $g){
            $tmp=collection(AdminRule::where('parent_id',$g->id)->field('id,name,title,parent_id')->select())->toArray();
            $child=[];
            foreach ($tmp as $tmps) {
                $child[$tmps['id']]=$tmps;
            }
            $g['children']=$child;
            unset($child);
            unset($tmp);
            $rulelist[$g['id']]=$g->toArray();
        }
        unset($rule);

        $this->assign('data',[
            'item'=>$data,
            'parent'=>$parent,
            'rule'=>$rulelist
        ]);
        return $this->fetch('rolepost');
    }


    /**
     * 提交角色内容
     * @param bool $data
     */
    private function submitRole($data=false)
    {
        $form=getForm();
        $vali=new Validate([
            'name|角色名称'=>'require|max:20',
            'content|备注内容'=>'max:255'
        ]);
        if(!$vali->check($form)){
            $this->error($vali->getError());
        }
        $rs=AdminRole::where('name',$form['name']);
        if($data){
            $rs->where('name','<>',$data->name);
        }
        if($rs->value('id')){
            $this->error("角色名称“{$form['name']}”已经存在");
        }
        if(!$data) $data=new AdminRole;
        $data->name=$form['name'];
        $data->group_id=empty($form['group_id']) ? 0 : $form['group_id'];
        $data->content=isset($form['content']) ? $form['content'] : '';
        $data->save();
        $id=empty($data->id) ? $data->insertGetId() : $data->id;
        // 更新规则
        if(isset($form['auth']) && is_array($form['auth'])){
            AdminRuleAccess::where('role_id',$id)->delete();
            foreach ($form['auth'] as $rule_id=>$bool){
                if($rule_id>0 && $bool){
                    AdminRuleAccess::create([
                        'role_id'=>$id,
                        'rule_id'=>$rule_id
                    ]);
                }
            }
        }
        $this->result(['id'=>$id]);
    }

    /**
     * 删除
     */
    public function deleterole()
    {
        $id=input('post.id',0,'intval');
        if(empty($id)){
            $this->error('角色不存在','lists');
        }
        $data=AdminRole::where('id',$id)->field('id')->find();
        if(!$data){
            $this->error('角色不存在','lists');
        }
        $data->delete();
        AdminRuleAccess::where('role_id',$id)->delete();
        $this->result(['id'=>$id]);

    }
}