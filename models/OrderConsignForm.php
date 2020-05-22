<?php


namespace app\models;


use yii\base\Model;

class OrderConsignForm extends Model
{
    public $id;
    public $logistic_company;
    public $logistic_no;
    public $logistic_status;

    public function rules()
    {
        return [
            [['id', 'logistic_company', 'logistic_no'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => '订单id',
            'logistic_company' => '快递公司',
            'logistic_no' => '快递单号',
            'logistic_status' => '状态',
        ];
    }
}
