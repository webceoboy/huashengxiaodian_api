<?php


namespace app\services;

use app\models\Order;
use EasyWeChat\Factory;
use GuzzleHttp\RequestOptions;

class WeChatService
{


    public static function getApp()
    {
        $config = [
            'app_id' => $_ENV['WX_APP_ID'],
            'secret' => $_ENV['WX_APP_SECRET'],

            // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
            'response_type' => 'array',

            'log' => [
                'default' => 'dev', // 默认使用的 channel，生产环境可以改为下面的 prod
                'channels' => [
                    // 测试环境
                    'dev' => [
                        'driver' => 'single',
                        'path' => \Yii::getAlias('@app/runtime/logs/easywechat.log'),
                        'level' => 'debug',
                    ],
                    // 生产环境
                    'prod' => [
                        'driver' => 'daily',
                        'path' => \Yii::getAlias('@app/runtime/logs/easywechat.log'),
                        'level' => 'info',
                    ],
                ],
            ],
            'http' => [
                RequestOptions::VERIFY => false,
            ]

        ];

        $app = Factory::officialAccount($config);
        return $app;
    }

    public static function sendTplMsg($openid, $tpl_id, $url, $data = [])
    {
        $app = self::getApp();
        return $app->template_message->send([
            'touser' => $openid,
            'template_id' => $tpl_id,
            'url' => $url,

            'data' => $data,
        ]);

    }

    public static function sendOrderNotify(Order $order)
    {
        return self::sendTplMsg($_ENV['WX_OPENID'], $_ENV['WX_TPL_ID'], 'http://m.baidu.com',[
            'content' => implode("r\n", [
                sprintf('订单号：%s', $order->order_no),
                sprintf('金额：%s', $order->total_fee),
                sprintf('收件人：%s', $order->receiver_name),
            ])
        ]);
    }
}
