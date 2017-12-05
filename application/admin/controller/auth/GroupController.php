<?php
/**
 * [KeCms] Copyright (c) 2017 kecms.cn
 * [Author] King east ( 1207877378@qq.com )
 */

namespace app\admin\controller\auth;



use app\admin\model\Admin;
use app\admin\model\AdminGroup;
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

}