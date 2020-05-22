<?php


namespace app\enums;


use yii2mod\enum\helpers\BaseEnum;

class ConsignStatusEnum extends BaseEnum
{

    const PEDDING = 0;
    const DELIVERING = 2;
    const SIGN = 2;
    const PROBLEM = 4;

    public static $list = [];
}
