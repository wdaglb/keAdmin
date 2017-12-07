<?php
// +----------------------------------------------------------------------
// | Name: keAdmin
// | Author King east To 1207877378@qq.com
// +----------------------------------------------------------------------

namespace app\admin\behavior;


use ke\Controller;
use ke\Glo;

class MenuManage
{
    private $list=[];

    public function create(array $option)
    {
        return array_push($this->list,$option)-1;
    }

    public function add($key,$title,$url,array $params=[])
    {
        $url=url($url);
        $option=array_merge([
            'title'=>$title,
            'url'=>$url
        ],$params);
        if(isset($this->list[$key]['children'])){
            return array_push($this->list[$key]['children'],$option)-1;
        }else{
            $this->list[$key]['children'][]=$option;
            return count($this->list[$key]['children'])-1;
        }
    }

    public function toArray()
    {
        return $this->list;
    }

    public function close()
    {
        unset($this->list);
    }
}

class Menu extends Controller
{
    public function run($request)
    {
        $control=$request->controller() . '/' . $request->action();
        if($control=='Auth/login'){
            return;
        }
        $menu=new MenuManage();
        $access=Glo::get('AccessAction');


        if($access->isAuth('user')) {
            $i = $menu->create(['title' => '会员']);
            if($access->isAuth('user.group/lists')) {
                $menu->add($i, '会员组管理', 'user.group/lists', ['icon' => 'group']);
            }
            if($access->isAuth('user/lists')) {
                $menu->add($i, '会员管理', 'user/lists', ['icon' => 'user']);
            }
            if($access->isAuth('user.finance/lists')) {
                $menu->add($i, '财务记录', 'user.finance/lists', ['icon' => 'retweet']);
            }
        }


        if($access->isAuth('sys')) {
            $i = $menu->create(['title' => '系统']);
            if($access->isAuth('setting/system')) {
                $menu->add($i, '系统设置', 'setting/system', ['icon' => 'cog']);
            }
            if($access->isAuth('auth.group/lists')) {
                $menu->add($i, '权限管理', 'auth.group/lists', ['icon' => 'vcard-o']);
            }
            if($access->isAuth('auth.manage/lists')) {
                $menu->add($i, '管理员管理', 'auth.manage/lists', ['icon' => 'address-book-o']);
            }
            if($access->isAuth('auth.log/lists')) {
                $menu->add($i, '管理日志', 'auth.log/lists', ['icon' => 'file-text-o']);
            }
        }

        $this->assign('menulist',$menu->toArray());
        $this->assign('curr',0);

        $menu->close();
        unset($menu);


    }

}