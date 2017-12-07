<?php
// +----------------------------------------------------------------------
// | Name: keAdmin
// | Author King east To 1207877378@qq.com
// +----------------------------------------------------------------------

namespace app\admin\model;


use think\Model;

class AdminLog extends Model
{
    public static function write($desc)
    {
        $r=new AdminLog;
        $r->id=uniqid().date('His',$_SERVER['REQUEST_TIME']).str_pad(mt_rand(0,99999),6,'0');
        $r->user_id=request()->adminInfo->id;
        $r->desc=$desc;
        $r->create_time=$_SERVER['REQUEST_TIME'];
        $r->save();
    }

}