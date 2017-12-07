<?php
/**
 * [KeCms] Copyright (c) 2017 kecms.cn
 * [Author] King east ( 1207877378@qq.com )
 */

return [
    'module_init'  => [
        \app\admin\behavior\Auth::class,
        \app\admin\behavior\AccessAction::class,
        \app\admin\behavior\Menu::class
    ]
];