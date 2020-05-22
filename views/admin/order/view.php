<?php

use app\enums\LogisticCompanyEnum;
use app\models\Order;
use app\models\OrderConsignForm;
use app\models\OrderItem;
use app\models\UpdatePriceForm;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = '订单详情';
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="box box-primary order-view">

    <div class="box-body">
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
                        ['attribute' => 'fixed_fee', 'format' => 'raw', 'value' => function (Order $model) {
                            $html = $model->fixed_fee;
                            return $html . '&nbsp;&nbsp;' . Html::button('修改', ['class' => 'btn btn-xs btn-success', 'data-toggle' => "modal", 'data-target' => "#w3"]);
                        }],
                        'fixed_reason',
                        'coin_fee',
                        'amount',

                        ['attribute' => 'seller_message', 'format' => 'raw', 'value' => function (Order $model) {
                            return Html::tag('span', $model->seller_message, ['class' => 'label label-warning']);
                        }],
                        'time:datetime',
                        'paytime:datetime',
                        //'wx_transaction_id',
                        //'trade_no',


                    ],
                ]) ?>
            </div>
            <div class="col-xs-12 col-md-6"><?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [

                        ['attribute' => 'receiver_name', 'format' => 'raw', 'value' => function (Order $model) {
                            $html = $model->receiver_name;
                            return $html . '&nbsp;&nbsp;' . Html::button('发货', ['class' => 'btn btn-xs btn-success', 'data-toggle' => "modal", 'data-target' => "#w5"]);
                        }],
                        'receiver_phone',
                        ['attribute' => 'receiver_state', 'value' => function (Order $order) {
                            $address = implode(' ', [$order->receiver_city, $order->receiver_district, $order->receiver_address]);
                            $text = implode(' ', ['姓名：' . $order->receiver_name, '地址：' . $address, '电话：' . $order->receiver_phone]);
                            return $address . '&nbsp;&nbsp;' . Html::button('复制', ['class' => 'btn btn-success btn-xs', 'data-clipboard-text' => $text]);
                        }, 'label' => '地址', 'format' => 'raw'],
                        'buyer_nickname',
                        ['label' => '物流', 'format' => 'raw', 'value' => function (Order $model) {
                            $logistics = ArrayHelper::getValue($model->getRawArray(), 'logistics', []);
                            $item = isset($logistics[0]) ? $logistics[0] : [];
                            if ($item) return sprintf('%s（<span class="btn" "data-clipboard-text"="%s" style="    text-decoration: underline;    cursor: pointer;">%s</span>）', $item['company'], $item['no'], $item['no']);
                            return '-';
                        }],
                        'vendor',
                        ['attribute' => 'buyer_message', 'format' => 'raw', 'value' => function (Order $model) {
                            return Html::tag('span', $model->buyer_message, ['class' => 'label label-warning']);
                        }],
                        'refund_state',
                        'refund_type',
                        'refund_fee',
                        'refund_reason',
                        'refund_time:datetime',
                        'trade_no',
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
</div>


<?php Modal::begin([
    'header' => '<h3>修改价格</h3>',
    //'toggleButton' => ['label' => 'click me'],
]) ?>
<?php $updatePriceForm = new UpdatePriceForm();
$form = ActiveForm::begin([
    'action' => ['admin/order/price'],
]); ?>
<?= Html::activeHiddenInput($updatePriceForm, 'id', ['value' => $model->id]) ?>
<?= $form->field($updatePriceForm, 'fixed_amount')->textInput(); ?>
<?= $form->field($updatePriceForm, 'fixed_reason')->textInput(); ?>
<?= Html::submitButton('保存', ['class' => 'btn  btn-primary']) ?>
<?php ActiveForm::end(); ?>

<?php Modal::end(); ?>


<?php Modal::begin([
    'header' => '<h3>发货</h3>',
    //'toggleButton' => ['label' => 'click me'],
]) ?>
<?php $orderConsignForm = new OrderConsignForm();
$form = ActiveForm::begin([
    'action' => ['admin/order/consign'],
]); ?>
<?= Html::activeHiddenInput($orderConsignForm, 'id', ['value' => $model->id]) ?>
<?= $form->field($orderConsignForm, 'logistic_company')->dropDownList(LogisticCompanyEnum::listData(), ['prompt' => '请选择物流公司']); ?>
<?= $form->field($orderConsignForm, 'logistic_no')->textInput(); ?>
<?= Html::submitButton('保存', ['class' => 'btn  btn-primary']) ?>
<?php ActiveForm::end(); ?>

<?php Modal::end(); ?>

<?php
$this->registerJs(<<<JS

var clipboard=new ClipboardJS('.btn');
 clipboard.on('success', function (e) {
                alert('复制成功');

                e.clearSelection();
            });
            clipboard.on('error', function (e) {
                alert('复制失败');
            });
JS
);

?>
