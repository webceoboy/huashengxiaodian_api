<?php


namespace app\enums;


use yii2mod\enum\helpers\BaseEnum;

class OrderTypeEnum extends BaseEnum
{

    const COMMON = 0;
    const PIN_TUAN = 1;
    const GIFT = 2;

    public static $list = [
        self::COMMON => '普通订单',
        self::PIN_TUAN => '拼团订单',
        self::GIFT => '礼品订单',
    ];
}
