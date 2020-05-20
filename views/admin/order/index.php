<?php

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


                'order_no',
                'status',
                'type',
                'total_fee',
                //'discount_fee',
                //'postage',
                //'fixed_fee',
                //'fixed_reason',
                //'coin_fee',
                //'amount',
                'seller_message',
                'time:datetime',
                'paytime:datetime',
                //'wx_transaction_id',
                'trade_no',
                //'vendor',
                'receiver_name',
                'receiver_phone',
                'receiver_state',
                'receiver_city',
                'receiver_district',
                'receiver_address',
                'buyer_nickname',
                //'openid',
                'buyer_message',
                //'refund_state',
                //'refund_type',
                //'refund_fee',
                //'refund_reason',
                //'refund_time:datetime',
                //'raw:ntext',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>

    </div>
</div>
