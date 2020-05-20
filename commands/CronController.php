<?php


namespace app\commands;


use app\services\ApiService;
use app\services\AppService;
use yii\console\Controller;
use yii\mutex\MysqlMutex;

class CronController extends Controller
{

    public function actionIndex()
    {
        $mutex = new MysqlMutex();
        if ($mutex->acquire('flush_order', 10)) {
            ApiService::updateOrderList();
        }
    }

    public function actionInit()
    {
        $mutex = new MysqlMutex();
        if ($mutex->acquire('flush_order', 10)) {
            AppService::fecthAllOrders();;
        }
    }
}
