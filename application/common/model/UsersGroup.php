<?php
// +----------------------------------------------------------------------
// | Name: keAdmin
// | Author King east To 1207877378@qq.com
// +----------------------------------------------------------------------

namespace app\common\model;


use think\Model;

class UsersGroup extends Model
{
    public function users()
    {
        return $this->hasMany('Users','group_id','id');

    }

}