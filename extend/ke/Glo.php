<?php
/**
 * [KeCms] Copyright (c) 2017 kecms.cn
 * [Author] King east ( 1207877378@qq.com )
 */

namespace ke;


class Glo
{
    public static $vars=[];

    public static function set($key,$value)
    {
        self::$vars[$key] = $value;
    }

    public static function get($key,$value=null)
    {
        return isset(self::$vars[$key]) ? self::$vars[$key] : $value;

    }

}