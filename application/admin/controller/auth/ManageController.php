<?php
// +----------------------------------------------------------------------
// | Name: keAdmin
// | Author King east To 1207877378@qq.com
// +----------------------------------------------------------------------

namespace app\admin\controller\auth;


use app\admin\model\Admin;
use ke\Controller;

class ManageController extends Controller
{
    public function lists()
    {
        $list=Admin::select();
        $this->assign('list',$list);
        return $this->fetch();
    }

}