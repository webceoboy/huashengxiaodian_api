<?php

use app\enums\OrderStatusEnum;
use app\models\Order;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '订单';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box order-index  box-primary">


    <div class="box-header with-border">

    </div>

    <div class="box-body table-responsive no-padding">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
                'buyer_nickname',
                //'order_no',
                'total_fee',
                'paytime:datetime',
                ['attribute' => 'status', 'value' => function (Order $model) {
                    return $model->getStatusLabel();
                }, 'filter' => OrderStatusEnum::listData()],
                //'type',

                //'discount_fee',
                //'postage',
                //'fixed_fee',
                //'fixed_reason',
                //'coin_fee',
                //'amount',
                'seller_message',
                'buyer_message',
                //'time:datetime',

                //'wx_transaction_id',
                //'trade_no',
                //'vendor',
                'receiver_name',
                'receiver_phone',
                ['attribute' => 'receiver_state', 'value' => function (Order $order) {
                    return implode(' ', [$order->receiver_state, $order->receiver_city, $order->receiver_district]);
                }],

                'receiver_address',

                //'openid',
                //'buyer_message',
                //'refund_state',
                //'refund_type',
                //'refund_fee',
                //'refund_reason',
                //'refund_time:datetime',
                //'raw:ntext',


            ],
        ]); ?>

    </div>
</div>
