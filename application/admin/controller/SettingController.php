<?php
// +----------------------------------------------------------------------
// | Name: keAdmin
// | Author King east To 1207877378@qq.com
// +----------------------------------------------------------------------

namespace app\admin\controller;


use app\admin\model\AdminLog;
use ke\Controller;
use think\Request;
use think\Validate;

class SettingController extends Controller
{
    public function system(Request $request)
    {
        if($this->isPost()){
            $form=getForm();
            $vali=new Validate([
                'title|站点标题'=>'require|max:50',
                'keywords'=>'max:255',
                'description'=>'max:255',
                'closedesc'=>'max:255'
            ]);
            if(!$vali->check($form)){
                $this->error($vali->getError());
            }
            $keywords=isset($form['keywords']) ? $form['keywords'] : '';
            $description=isset($form['description']) ? $form['description'] : '';
            $closedesc=isset($form['closedesc']) ? $form['closedesc'] : '';
            $status=empty($form['status']) ? 0 : 1;
            $request->siteInfo->title=$form['title'];
            $request->siteInfo->keywords=$keywords;
            $request->siteInfo->description=$description;
            $request->siteInfo->closedesc=$closedesc;
            $request->siteInfo->status=$status;
            $request->siteInfo->save();
            AdminLog::write('修改站点设置');
            $this->result([]);
        }
        $this->assign('data',[
            'item'=>$request->siteInfo
        ]);

        return $this->fetch();
    }

}