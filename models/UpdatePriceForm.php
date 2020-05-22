<?php


namespace app\models;


use yii\base\Model;

class UpdatePriceForm extends Model

{

    public $id;
    public $fixed_amount;
    public $fixed_reason;

    public function rules()
    {
        return [
            [['id', 'fixed_amount', 'fixed_reason'], 'required'],
            [['fixed_amount'], 'number'],
            ['fixed_reason', 'string', 'max' => 64]
        ];
    }

    public function attributeLabels()
    {
        return [
            'fixed_amount' => '修改价格',
            'fixed_reason' => '修改理由',
        ];
    }
}
