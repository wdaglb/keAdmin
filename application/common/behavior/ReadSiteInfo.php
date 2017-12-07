<?php
// +----------------------------------------------------------------------
// | Name: keAdmin
// | Author King east To 1207877378@qq.com
// +----------------------------------------------------------------------

namespace app\common\behavior;


use app\common\model\Site;

class ReadSiteInfo
{
    public function run(&$request)
    {
        $siteInfo=Site::where('use',1)->find();
        if($siteInfo){
            $request->siteInfo=$siteInfo;
        }else{
            $siteInfo=new Site;
            $siteInfo->use=1;
            $siteInfo->title='默认站点';
            $siteInfo->keywords='';
            $siteInfo->description='';
            $siteInfo->save();
            $request->siteInfo=$siteInfo;
        }

    }

}