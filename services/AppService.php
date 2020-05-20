<?php

namespace app\services;

use app\models\Order;

class AppService
{

    public static function sendOrderNotify(Order $order)
    {
        $text = implode("；", [
            sprintf('订单号：%s', $order->order_no),
            sprintf('金额：%s', $order->total_fee),
            sprintf('收件人：%s', $order->receiver_name),
        ]);

        return self::sendBark('订单提醒', $text);
    }

    public static function sendBark($title, $content)
    {
        $client = ApiService::getClient();
        return $client->get(sprintf('%s/%s/%s', $_ENV['BARK_URL'], $title, $content))->getBody()->getContents();
    }
}
