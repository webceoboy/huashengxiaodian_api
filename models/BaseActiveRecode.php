<?php


namespace app\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class BaseActiveRecode extends ActiveRecord
{


    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
            ],
            /*  'softDelete' => [
                  'class' => SoftDeleteBehavior::class,
                  'softDeleteAttributeValues' => [
                      'is_deleted' => 1,
                      'deleted_at' => time(),
                  ]
              ]*/
        ];
    }
}
