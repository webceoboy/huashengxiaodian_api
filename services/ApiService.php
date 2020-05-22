<?php


namespace app\services;


use app\models\Order;
use app\models\OrderConsignForm;
use app\models\OrderItem;
use app\models\UpdatePriceForm;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use yii\helpers\ArrayHelper;
use yii\web\ServerErrorHttpException;

class ApiService
{
    const TOKEN_KEY = 'weidian_access_token';

    /**
     * @return Client
     */
    public static function getClient()
    {
        $handler = new CurlHandler();
        $stack = HandlerStack::create($handler); // Wrap w/ middleware
        $fp = fopen(\Yii::getAlias('@app/runtime/logs/api.log'), 'a+');
        $client = new Client(['handler' => $stack, 'debug' => $fp, 'verify' => false]);

        return $client;
    }

    public static function getConfig()
    {
        static $config;
        if (!is_array($config)) $config = require_once \Yii::getAlias('@app/config/weidian.php');
        return $config;
    }

    public static function getBaseUrl()
    {
        $wd = self::getConfig();
        return sprintf('%s://%s', $wd['scheme'], $wd['domain']);
    }

    public static function getTokenUrl()
    {
        $wd = self::getConfig();
        return self::getUrl('api/token/grant.json', [
            'appid' => $wd['appid'],
            'secret' => $wd['secret'],
        ]);
    }

    public static function getUrl($url, $query = [])
    {
        $wd = self::getConfig();
        return sprintf('%s/%s?%s', self::getBaseUrl(), $url, http_build_query($query));
    }

    public static function fetchToken()
    {
        $client = self::getClient();
        $json = json_decode($client->get(self::getTokenUrl(), [])->getBody()->getContents(), true);
        if (isset($json['access_token'])) {

            return $json['access_token'];
        }
        \Yii::error($json);
        throw new ServerErrorHttpException('获取token失败');
    }

    public static function getToken()
    {
        return \Yii::$app->cache->getOrSet(self::TOKEN_KEY, function () {
            return self::fetchToken();
        }, 7200 - 1);
    }

    public static function request($method = 'get', $api, $query = [])
    {
        $query['access_token'] = self::getToken();
        $url = self::getUrl('api/' . $api, $query);
        $client = self::getClient();
        $options = $method == 'get' ? ['query' => $query] : ['form_params' => $query];
        $result = json_decode($client->request($method, $url, $options)->getBody()->getContents(), true);
        if (is_array($result)) {
            if (isset($result['errcode']) && is_numeric($result['errcode']) && $result['errcode'] == 0) {
                return $result;
            } else {

                \Yii::error($result);
                throw new \Exception('接口请求失败：' . $result['errmsg']);
            }
        }
        return [];
    }

    public static function getOrderList($query = [])
    {
        return self::request('get', 'mag.admin.order.list.json', $query);
    }

    public static function saveOrder($order)
    {
        $model = Order::findOne(['order_no' => $order['order_no']]);
        if (!$model) {
            $model = new Order();
        }
        $new = $model->getIsNewRecord();
        $model->setAttributes($order);
        foreach (['receiver', 'buyer', 'refund'] as $sub) {
            $model->setAttributes(ArrayHelper::getValue($order, $sub, []));
        }

        if ($model->save()) {
            if ($new) {
                foreach (ArrayHelper::getValue($order, 'items', []) as $arr) {
                    $item = new OrderItem();
                    $item->setAttributes($arr);
                    $item->order_id = $model->id;
                    $item->save();
                    if ($item->hasErrors()) {
                        $model->delete();
                        throw new \Exception(array_values($item->getFirstErrors())[0]);
                    }
                }
            }
        } else throw new \Exception(array_values($model->getFirstErrors())[0]);
    }

    public static function updateOrderList($query = [])
    {
        $result = self::getOrderList($query);
        foreach ($result['orders'] as $order) {
            self::saveOrder($order);
        }
    }

    public static function img($url)
    {
        $client = self::getClient();
        return $client->get($url, [
            'headers' => [
                'Referer' => $url,
            ]
        ])->getBody()->getContents();

    }

    public static function updateOrder($id)
    {
        $result = self::request('get', 'mag.admin.order.get.json', ['id' => $id]);
        self::saveOrder($result['order']);
        return $result;
    }

    public static function updatePrice(UpdatePriceForm $model)
    {
        $result = self::request('post', 'mag.admin.order.fix.json', $model->toArray());
        return $result;
    }

    public static function orderConsign(OrderConsignForm $model)
    {
        $result = self::request('post', 'mag.admin.order.consign.json', $model->toArray());
        return $result;
    }
}
