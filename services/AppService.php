<?php

namespace app\services;

use app\models\Order;
use yii\helpers\ArrayHelper;
use yii\helpers\StringHelper;

class AppService
{

    public static function sendOrderNotify(Order $order)
    {
        $detail = [];
        foreach ($order->items as $item) {
            $detail[] = sprintf('%s(%d)', StringHelper::truncate($item->title, 6, ''), $item->quantity);
        }
        $text = implode("；", [
            sprintf('金额：%s', $order->amount),
            sprintf('收件人：%s(%s-%s)', $order->receiver_name, $order->receiver_state, $order->receiver_city),
            sprintf('商品：%s', implode(',', $detail)),
        ]);
        return self::sendBark(ArrayHelper::getValue($_ENV, 'BARK_TITLE', '订单提醒'), $text);
    }

    public static function sendBark($title, $content)
    {
        $client = ApiService::getClient();
        if (!$_ENV['BARK_URL']) return false;
        foreach (explode(',', $_ENV['BARK_URL']) as $uid) {
            $client->get(sprintf('%s/%s/%s', $uid, $title, $content))->getBody()->getContents();
        }

    }

    public static function fecthAllOrders()
    {
        $_ENV['BARK_URL'] = false;
        for ($i = time(); $i > strtotime('-3 year'); $i -= 86400 * 7) {
            ApiService::updateOrderList(['start_time' => $i - 86400 * 7, 'end_time' => $i]);
        }
    }
}
