<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '订单';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
