<?php


namespace app\controllers\admin;


use yii\filters\auth\HttpBasicAuth;
use yii\helpers\ArrayHelper;

class Controller extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'basic' => [
                'class' => HttpBasicAuth::class,
                'auth' => function ($username, $password) {
                    if ($username == ArrayHelper::getValue($_ENV, 'ADMIN_USER', 'admin') && $password == ArrayHelper::getValue($_ENV, 'ADMIN_PASS', 'admin888')) {
                        return true;
                    }
                    return null;
                }
            ]
        ];
    }
}
