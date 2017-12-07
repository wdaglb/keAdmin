<?php
// +----------------------------------------------------------------------
// | Name: keAdmin
// | Author King east To 1207877378@qq.com
// +----------------------------------------------------------------------

namespace app\common\model;


use think\Model;

class Users extends Model
{
    public static function add($data)
    {
        $s=['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        $id=$s[date('Y')-2017].$_SERVER['REQUEST_TIME'].str_pad(mt_rand(0,99999999),8,'0');
        $r=new self;
        $data['id']=$id;
        $data['create_time']=$_SERVER['REQUEST_TIME'];
        return $r->save($data);
    }

    public function setPassAttr($input)
    {
        $private=rand_letter(10);
        $this->setAttr('private',$private);
        return md5($input.sha1($private));
    }

}