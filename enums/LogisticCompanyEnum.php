<?php


namespace app\enums;


use yii2mod\enum\helpers\BaseEnum;

class LogisticCompanyEnum extends BaseEnum
{

    const EMS = 'ems';
    const YZPY = 'YZPY';
    const DBL = 'DBL';
    const SF = 'SF';
    const ZTO = 'ZTO';
    const JD = 'JD';
    const XIANXIA = '线下配送';
    const SELF = '自提';

    public static $list = [
        self::EMS => 'EMS',
        self::YZPY => '邮政快递包裹',
        self::DBL => '德邦快递',
        self::SF => '顺丰',
        self::ZTO => '中通快递',
        self::JD => '京东物流',
        self::XIANXIA => '线下配送',
        self::SELF => '自提',
    ];
}
