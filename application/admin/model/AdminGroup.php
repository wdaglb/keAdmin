<?php
// +----------------------------------------------------------------------
// | Name: keAdmin
// | Author King east To 1207877378@qq.com
// +----------------------------------------------------------------------

namespace app\admin\model;


use think\Model;

class AdminGroup extends Model
{
    protected $autoWriteTimestamp=true;

    public function getLeafAttr()
    {
        return is_numeric($this->where('parent_id',$this->getAttr('id'))->value('id')) ? false : true;
    }

}