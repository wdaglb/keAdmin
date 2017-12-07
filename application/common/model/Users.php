<?php
// +----------------------------------------------------------------------
// | Name: keAdmin
// | Author King east To 1207877378@qq.com
// +----------------------------------------------------------------------

namespace app\common\model;


use think\Model;

class Users extends Model
{
    protected $append=['group'];
    public function setPassAttr($input)
    {
        $private=rand_letter(10);
        $this->setAttr('private',$private);
        return md5($input.sha1($private));
    }

    public function getGroupAttr()
    {
        $g=UsersGroup::where('id',$this->getAttr('group_id'))->value('name');
        return $g ? $g : '未知用户组';
    }

    public function setIntegralAttr($input)
    {
        $group=UsersGroup::field('id,integral')->where('integral','<=',$input)->order('integral','desc')->value('id');
        if($group){
            $this->setAttr('group_id',$group);
        }
        return $input;
    }

}