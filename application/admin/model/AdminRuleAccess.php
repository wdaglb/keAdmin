<?php
// +----------------------------------------------------------------------
// | Name: keAdmin
// | Author King east To 1207877378@qq.com
// +----------------------------------------------------------------------

namespace app\admin\model;


use think\Model;

class AdminRuleAccess extends Model
{
    public function rule()
    {
        return $this->hasOne('AdminRule','id','rule_id')->bind([
            'controller'
        ]);
    }

}