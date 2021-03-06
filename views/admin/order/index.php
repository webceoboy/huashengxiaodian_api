<?php

use app\enums\OrderStatusEnum;
use app\models\Order;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '订单管理';
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

                ['attribute' => 'buyer_nickname', 'format' => 'raw', 'value' => function (Order $model) {
                    return Html::a($model->buyer_nickname, ['view', 'id' => $model->id]);
                }],
                //'order_no',
                'amount',

                ['attribute' => 'status', 'value' => function (Order $model) {
                    return $model->getStatusLabel();
                }, 'filter' => OrderStatusEnum::listData()],
                'paytime:datetime',
                //'type',

                //'discount_fee',
                //'postage',
                //'fixed_fee',
                //'fixed_reason',
                //'coin_fee',
                //'amount',

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
                'seller_message',
                'buyer_message',
                ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {delete}'],

            ],
        ]); ?>

    </div>
</div>
