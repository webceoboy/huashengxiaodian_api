<?php


namespace app\commands;


use app\services\ApiService;
use app\services\AppService;
use yii\console\Controller;
use yii\helpers\ArrayHelper;
use yii\mutex\MysqlMutex;

class CronController extends Controller
{

    public function actionIndex()
    {
        $mutex = new MysqlMutex();
        if ($mutex->acquire('flush_order', 10)) {
            ApiService::updateOrderList(['start_time' => time() - ArrayHelper::getValue($_ENV, 'SCHEDULE_DAYS', 14), 'end_time' => time()]);
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
