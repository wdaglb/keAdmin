<?php
/**
 * [KeCms] Copyright (c) 2017 kecms.cn
 * [Author] King east ( 1207877378@qq.com )
 */

namespace app\common\model;


use think\Model;

class UsersFinance extends Model
{
    protected $append=['typesName','payTypes'];
    /**
     * 写入财务记录
     * @param $uid 用户ID
     * @param $money 充值金额
     * @param array $attr 额外参数
     *                    type 0金额 1积分
     *                    paytype 支付方式
     *                    action_id 操作ID
     *                    desc 备注
     * @return bool|mixed|string
     */
    public static function write($uid,$money,array $attr=[])
    {
        $r=new self;
        $r->id='LG'.date('Ymd').rand_letter(6).uniqid().str_pad(mt_rand(0,999999),6,'0');
        $r->user_id=$uid;
        $r->money=$money;
        $r->types=isset($attr['type']) ? $attr['type'] : 0;
        $r->desc=isset($attr['desc']) ? $attr['desc'] : '';
        $r->paytype=empty($attr['paytype']) ? 0 : $attr['paytype'];
        $r->action_id=empty($attr['action_id']) ? 0 : $attr['action_id'];
        $r->create_time=$_SERVER['REQUEST_TIME'];
        return $r->save();
    }

    public function getTypesNameAttr()
    {
        return $this->getAttr('types') ? '积分' : '金额';
    }

    public function getPayTypesAttr()
    {
        switch ($this->getAttr('paytype')){
            default:
                return '后台付款 | ID:'.$this->getAttr('action_id');
        }
    }

}