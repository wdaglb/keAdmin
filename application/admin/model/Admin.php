<?php
// +----------------------------------------------------------------------
// | Name: keAdmin
// | Author King east To 1207877378@qq.com
// +----------------------------------------------------------------------

namespace app\admin\model;


use think\Model;

class Admin extends Model
{
    protected $autoWriteTimestamp = true;

    public function chkPass($input)
    {
        return md5($input.sha1($this->getAttr('private')))===$this->getAttr('pass');
    }

    public function setPassAttr($input)
    {
        $private=rand_letter(10);
        $this->setAttr('private',$private);
        return md5($input.sha1($private));
    }

}