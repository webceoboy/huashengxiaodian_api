<?php

use app\models\Order;
use app\models\OrderItem;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = '订单详情';
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">


    <div class="row">


        <div class="col-xs-12 col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'order_no',
                    ['attribute' => 'status', 'value' => function (Order $model) {
                        return $model->getStatusLabel();
                    }],
                    /*['attribute' => 'type', 'value' => function (Order $model) {
                        return $model->getTypeLabel();
                    }],*/
                    'total_fee',
                    'discount_fee',
                    'postage',
                    'fixed_fee',
                    'fixed_reason',
                    'coin_fee',
                    'amount',
                    'seller_message',
                    'time:datetime',
                    'paytime:datetime',
                    //'wx_transaction_id',
                    //'trade_no',
                    'vendor',

                ],
            ]) ?>
        </div>
        <div class="col-xs-12 col-md-6"><?= DetailView::widget([
                'model' => $model,
                'attributes' => [

                    'receiver_name',
                    'receiver_phone',
                    ['attribute' => 'receiver_state', 'value' => function (Order $order) {
                        return implode(' ', [$order->receiver_state, $order->receiver_city, $order->receiver_district]);
                    }],
                    'receiver_address',
                    'buyer_nickname',
                    'openid',
                    'buyer_message',
                    'refund_state',
                    'refund_type',
                    'refund_fee',
                    'refund_reason',
                    'refund_time:datetime',
                ],
            ]) ?></div>
    </div>
    <div class="table-responsive">
        <?= GridView::widget([
            'caption' => '订单内容',
            'layout' => '{items}',
           // 'filterModel' => new OrderItem(),
            'dataProvider' => new ArrayDataProvider(['allModels' => $model->items]),
            'columns' => [
                ['attribute' => 'image_url', 'format' => 'raw', 'value' => function (OrderItem $model) {
                    return Html::img($model->getProductImgUrl(), ['style' => 'width:5rem']);
                }],
                'title',
                //'product_no',
                //'sku_id',
                'sku_property_names',
                'quantity',
                //'original_price',
                //'price',
                // 'cost',
                //'total_fee',
                //'discount_fee',
                'amount'
            ]
        ]) ?>
    </div>
</div>
