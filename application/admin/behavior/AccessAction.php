<?php
// +----------------------------------------------------------------------
// | Name: keAdmin
// | Author King east To 1207877378@qq.com
// +----------------------------------------------------------------------

namespace app\admin\behavior;


use app\admin\model\AdminRuleAccess;
use ke\Controller;
use ke\Glo;

class __Access
{
    private $rulelist=[];

    private $cache=[];

    public function __construct($r)
    {
        $this->rulelist=$r;
    }

    public function isAuth($control)
    {
        if(empty($this->rulelist)) return true;
        if(in_array($control,$this->cache)) return true;
        foreach ($this->rulelist as $g){
            if($g['controller']!=''){
                if(preg_match($this->preg($g['controller']),$control,$match)){
                    $this->cache[]=$control;
                    return true;
                }
            }
        }
        return false;
    }
    private function preg($r)
    {
        return '/^'.str_replace(['*','/'],['[A-Za-z0-9_]+','\/'],$r).'$/';
    }
}

class AccessAction extends Controller
{
    // 不验证权限的路由
    private $noRed=[
        'index/index',
        'auth/errors',
        'auth/logout',
        'auth/pass'
    ];
    public function run(&$request)
    {
        $admin=$request->adminInfo;
        $control=strtolower($request->controller()) . '/' . $request->action();
        if(!$admin){
            return;
        }
        $rule=AdminRuleAccess::with('rule')->where('role_id',$admin->group_id)->select();
        $access=new __Access(collection($rule)->toArray());
        Glo::set('AccessAction',$access);
        if(in_array($control,$this->noRed)){
            return;
        }
        if(!$access->isAuth($control)){
            $this->redirect('auth/errors');
        }

    }

}