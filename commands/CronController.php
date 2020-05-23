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
            for ($i = 7; $i <= ArrayHelper::getValue($_ENV, 'SCHEDULE_DAYS', 14); $i += 7) {
                $start_time = time() - 86400 * $i;
                $end_time = $start_time + 86400 * 7;
                echo ApiService::updateOrderList(['start_time' => $start_time, 'end_time' => $end_time]);
            }
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
