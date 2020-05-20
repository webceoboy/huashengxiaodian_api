<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'order_no') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'total_fee') ?>

    <?php // echo $form->field($model, 'discount_fee') ?>

    <?php // echo $form->field($model, 'postage') ?>

    <?php // echo $form->field($model, 'fixed_fee') ?>

    <?php // echo $form->field($model, 'fixed_reason') ?>

    <?php // echo $form->field($model, 'coin_fee') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'seller_message') ?>

    <?php // echo $form->field($model, 'time') ?>

    <?php // echo $form->field($model, 'paytime') ?>

    <?php // echo $form->field($model, 'wx_transaction_id') ?>

    <?php // echo $form->field($model, 'trade_no') ?>

    <?php // echo $form->field($model, 'vendor') ?>

    <?php // echo $form->field($model, 'receiver_name') ?>

    <?php // echo $form->field($model, 'receiver_phone') ?>

    <?php // echo $form->field($model, 'receiver_state') ?>

    <?php // echo $form->field($model, 'receiver_city') ?>

    <?php // echo $form->field($model, 'receiver_district') ?>

    <?php // echo $form->field($model, 'receiver_address') ?>

    <?php // echo $form->field($model, 'buyer_nickname') ?>

    <?php // echo $form->field($model, 'openid') ?>

    <?php // echo $form->field($model, 'buyer_message') ?>

    <?php // echo $form->field($model, 'refund_state') ?>

    <?php // echo $form->field($model, 'refund_type') ?>

    <?php // echo $form->field($model, 'refund_fee') ?>

    <?php // echo $form->field($model, 'refund_reason') ?>

    <?php // echo $form->field($model, 'refund_time') ?>

    <?php // echo $form->field($model, 'raw') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
