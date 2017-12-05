<?php
/**
 * [KeCms] Copyright (c) 2017 kecms.cn
 * [Author] King east ( 1207877378@qq.com )
 */

namespace app\admin\controller\auth;



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
     */
    public function create()
    {
        if($this->isPost()){
            $form=getForm();
            $vali=new Validate([
                'name|用户组名称'=>'require|max:20',
                'content|备注内容'=>'max:255'
            ]);
            if(!$vali->check($form)){
                $this->error($vali->getError());
            }
            if(AdminGroup::where('name',$form['name'])->value('id')){
                $this->error("用户组名称“{$form['name']}”已经存在");
            }
            $data=new AdminGroup;
            $data->name=$form['name'];
            $data->content=isset($form['content']) ? $form['content'] : '';
            $data->valid=empty($form['valid']) ? 0 : 1;
            $data->save();
            $this->success('用户组创建成功','lists');

        }
        return $this->fetch();
    }

}