<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'order_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'total_fee')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'discount_fee')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'postage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fixed_fee')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fixed_reason')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coin_fee')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seller_message')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'time')->textInput() ?>

    <?= $form->field($model, 'paytime')->textInput() ?>

    <?= $form->field($model, 'wx_transaction_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'trade_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vendor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'receiver_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'receiver_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'receiver_state')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'receiver_city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'receiver_district')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'receiver_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'buyer_nickname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'openid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'buyer_message')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'refund_state')->textInput() ?>

    <?= $form->field($model, 'refund_type')->textInput() ?>

    <?= $form->field($model, 'refund_fee')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'refund_reason')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'refund_time')->textInput() ?>

    <?= $form->field($model, 'raw')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
