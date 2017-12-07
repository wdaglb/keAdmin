<?php
// +----------------------------------------------------------------------
// | Name: keAdmin
// | Author King east To 1207877378@qq.com
// +----------------------------------------------------------------------

namespace app\admin\controller\user;


use app\admin\model\AdminLog;
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
                    $rs->where('id|user',$key);
                };
            }

            $list=UsersGroup::where($where)->limit($start,$size)->select();
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
     * 保存内容
     * @param bool $data
     */
    private function submit($data=false)
    {
        $form=getForm();
        $vali=new Validate([
            'name|会员组名称'=>'require|max:20',
            'integral|备注内容'=>'require|number'
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
        $data->save();
        $id=empty($data->id) ? $data->insertGetId() : $data->id;
        AdminLog::write('设置会员组ID：'.$id);
        $this->result(['id'=>$id]);
    }

}