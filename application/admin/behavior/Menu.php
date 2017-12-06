<?php
// +----------------------------------------------------------------------
// | Name: keAdmin
// | Author King east To 1207877378@qq.com
// +----------------------------------------------------------------------

namespace app\admin\behavior;


use ke\Controller;

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
    public function run()
    {
        $menu=new MenuManage();

        $i=$menu->create(['title'=>'系统']);
        $menu->add($i,'系统设置','setting/system',['icon'=>'cog']);
        $menu->add($i,'权限管理','auth.group/lists',['icon'=>'vcard-o']);
        $menu->add($i,'管理员管理','auth.manage/lists',['icon'=>'address-book-o']);
        $menu->add($i,'管理日志','auth.log/lists',['icon'=>'file-text-o']);

        $this->assign('menulist',$menu->toArray());
        $this->assign('curr',0);

        $menu->close();
        unset($menu);


    }

}