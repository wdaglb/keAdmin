<?php
/**
 * [KeCms] Copyright (c) 2017 kecms.cn
 * [Author] King east ( 1207877378@qq.com )
 */

namespace ke;


class FileAction
{
    public static function remove($file)
    {
        return is_file($file) ? unlink($file) : false;
    }

}