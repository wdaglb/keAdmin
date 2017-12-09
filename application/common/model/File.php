<?php
/**
 * [KeCms] Copyright (c) 2017 kecms.cn
 * [Author] King east ( 1207877378@qq.com )
 */

namespace app\common\model;


use think\Model;

class File extends Model
{
    protected $append=['uploadDate','srcs'];
    public function getUploadDateAttr()
    {
        return date('Y-m-d',$this->getAttr('upload_time'));
    }

    public function getSrcsAttr()
    {
        return '/uploadfiles/'.$this->getAttr('src');

    }

    public static function add($data)
    {
        $r=new self;
        $r->id=md5('FS'.date('Ymd').rand_letter(6).uniqid().str_pad(mt_rand(0,9999),4,'0'));
        $r->mime=$data['mime'];
        $r->names=$data['name'];
        $r->ext=pathinfo($data['name'], PATHINFO_EXTENSION);
        $r->src=$data['src'];
        $r->upload_time=$_SERVER['REQUEST_TIME'];
        return $r->save() ? $r->id : false;
    }

    public static function uses($id)
    {
        $r=self::where('id',$id)->field('id')->find();
        $r->use=1;
        $r->save();
        return url('@attachment',['id'=>$id],'');

    }

}