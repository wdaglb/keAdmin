<?php
// +----------------------------------------------------------------------
// | Name: keAdmin
// | Author King east To 1207877378@qq.com
// +----------------------------------------------------------------------

namespace app\admin\model;


use think\Model;

class AdminRole extends Model
{

    public function ruleList()
    {
        return $this->hasManyThrough('AdminRule','AdminRuleAccess','ru_id','role_id','id');

    }

}