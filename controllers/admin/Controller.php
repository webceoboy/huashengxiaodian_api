<?php


namespace app\controllers\admin;


use yii\filters\AccessControl;

class Controller extends \yii\web\Controller
{

    public function behaviors()
    {


        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'create', 'update', 'view'],
                        'roles' => ['@'],
                    ],

                ],
            ],
        ];
    }
}
