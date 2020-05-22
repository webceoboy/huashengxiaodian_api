<?php

namespace app\models;

use app\enums\OrderStatusEnum;
use app\enums\OrderTypeEnum;
use app\services\AppService;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $order_no 订单号
 * @property int $status 状态
 * @property int $type 类型
 * @property float|null $total_fee 总价
 * @property float|null $discount_fee 优惠
 * @property float|null $postage 邮费
 * @property float|null $fixed_fee 改价
 * @property string|null $fixed_reason 改价理由
 * @property float|null $coin_fee 花生米
 * @property float|null $amount 合计
 * @property string|null $seller_message 卖家备注
 * @property int $time 下单时间
 * @property int|null $paytime 支付时间
 * @property string|null $wx_transaction_id 微信流水号
 * @property string $trade_no 流水
 * @property string|null $vendor 渠道
 * @property string|null $receiver_name 收件人
 * @property string|null $receiver_phone 收件人电话
 * @property string|null $receiver_state 收件人省份
 * @property string|null $receiver_city 收件人城市
 * @property string|null $receiver_district 收件人区域
 * @property string|null $receiver_address 收件人地址
 * @property string|null $buyer_nickname 买家微信
 * @property string|null $openid 买家open id
 * @property string|null $buyer_message 买家备注
 * @property int|null $refund_state 退款状态
 * @property int|null $refund_type 退款类型
 * @property float|null $refund_fee 退款
 * @property string|null $refund_reason 退款理由
 * @property int|null $refund_time 退款时间
 * @property string|null $raw
 * @property OrderItem[] $items
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'order_no', 'status', 'type', 'time', 'trade_no'], 'required'],
            [['status', 'type', 'time', 'paytime', 'refund_state', 'refund_type', 'refund_time'], 'integer'],
            [['total_fee', 'discount_fee', 'postage', 'fixed_fee', 'coin_fee', 'amount', 'refund_fee'], 'number'],
            [['raw'], 'string'],
            [['order_no', 'fixed_reason', 'trade_no', 'vendor', 'receiver_address', 'openid', 'buyer_message'], 'string', 'max' => 64],
            ['wx_transaction_id', 'safe'],
            [['seller_message', 'refund_reason'], 'string', 'max' => 128],
            [['receiver_name', 'receiver_phone', 'buyer_nickname'], 'string', 'max' => 32],
            [['receiver_state'], 'string', 'max' => 12],
            [['receiver_city', 'receiver_district'], 'string', 'max' => 16],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_no' => '订单号',
            'status' => '状态',
            'type' => '类型',
            'total_fee' => '总价',
            'discount_fee' => '优惠',
            'postage' => '邮费',
            'fixed_fee' => '改价',
            'fixed_reason' => '改价理由',
            'coin_fee' => '花生米',
            'amount' => '合计',
            'seller_message' => '卖家备注',
            'time' => '下单时间',
            'paytime' => '支付时间',
            'wx_transaction_id' => '微信流水号',
            'trade_no' => '流水',
            'vendor' => '渠道',
            'receiver_name' => '收件人',
            'receiver_phone' => '收件人电话',
            'receiver_state' => '收件人省份',
            'receiver_city' => '收件人城市',
            'receiver_district' => '收件人区域',
            'receiver_address' => '收件人地址',
            'buyer_nickname' => '买家微信',
            'openid' => '买家open id',
            'buyer_message' => '买家备注',
            'refund_state' => '退款状态',
            'refund_type' => '退款类型',
            'refund_fee' => '退款',
            'refund_reason' => '退款理由',
            'refund_time' => '退款时间',
            'raw' => 'Raw',
        ];
    }

    /**
     * {@inheritdoc}
     * @return OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderQuery(get_called_class());
    }

    public function getItems()
    {
        return $this->hasMany(OrderItem::class, ['order_id' => 'id']);
    }

    public function getStatusLabel()
    {
        return OrderStatusEnum::getLabel($this->status);
    }

    public function getTypeLabel()
    {
        return OrderTypeEnum::getLabel($this->type);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($insert) {
            AppService::sendOrderNotify($this);
        }
    }

    public function getRawArray()
    {
        return unserialize($this->raw);
    }
}
