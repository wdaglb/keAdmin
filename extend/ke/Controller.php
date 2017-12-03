<?php
/**
 * [KeCms] Copyright (c) 2017 kecms.cn
 * [Author] King east ( 1207877378@qq.com )
 */

namespace ke;

class Controller extends \think\Controller
{
    protected function result($data, $code = 1, $msg = '', $type = '', array $header = [])
    {
        parent::result($data,$code,$msg,$type,$header);
    }

    protected function isPost()
    {
        return $this->request->isPost();
    }
    protected function isGet()
    {
        return $this->request->isGet();
    }
    protected function isSsl()
    {
        return $this->request->isSsl();
    }

}