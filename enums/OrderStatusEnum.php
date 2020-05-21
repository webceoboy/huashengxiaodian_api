<?php


namespace app\enums;


use yii2mod\enum\helpers\BaseEnum;

class OrderStatusEnum extends BaseEnum
{

    const WAIT_PAY = 1;
    const WAIT_SEND = 2;
    const HAVE_SEND = 3;
    const OVER = 4;
    const REFUNDING = 5;
    const REFUNDED = 6;
    const CLIENT_CLOSE = 7;
    const TIME_OUT_CLOSE = 8;
    const SELLER_CLOSE = 9;
    const WAIT_GROUP = 10;

    public static $list = [
        self::WAIT_PAY => '待付款',
        self::WAIT_SEND => '代发货',
        self::HAVE_SEND => '已发货',
        self::OVER => '交易完成',
        self::REFUNDING => '申请退款',
        self::REFUNDED => '退款成功',
        self::CLIENT_CLOSE => '主动关闭',
        self::TIME_OUT_CLOSE => '自动关闭',
        self::SELLER_CLOSE => '商家关闭',
        self::WAIT_GROUP => '待成团',
    ];
}
