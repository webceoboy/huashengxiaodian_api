<?php

namespace app\models;

use yii\helpers\Url;

/**
 * This is the model class for table "order_item".
 *
 * @property int $id
 * @property int $order_id
 * @property string|null $title 商品
 * @property string $post_id 商品id
 * @property string|null $image_url 商品图片
 * @property string|null $product_no 商品编码
 * @property string|null $sku_id sku_id
 * @property string|null $sku_property_names 属性
 * @property int|null $quantity 数量
 * @property float|null $original_price 原价
 * @property float|null $price 售价
 * @property float|null $cost 成本
 * @property float|null $total_fee 总价
 * @property float|null $discount_fee 优惠金额
 * @property float|null $amount 合计
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class OrderItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id', 'order_id'], 'required'],
            [['quantity', 'created_at', 'updated_at'], 'integer'],
            [['original_price', 'price', 'cost', 'total_fee', 'discount_fee', 'amount'], 'number'],
            [['title', 'product_no', 'sku_id'], 'string', 'max' => 64, 'strict' => false],
            ['image_url', 'string', 'max' => 256],
            [['post_id'], 'string', 'max' => 16, 'strict' => false],
            [['sku_property_names'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '商品',
            'post_id' => '商品id',
            'image_url' => '商品图片',
            'product_no' => '商品编码',
            'sku_id' => 'sku_id',
            'sku_property_names' => '属性',
            'quantity' => '数量',
            'original_price' => '原价',
            'price' => '售价',
            'cost' => '成本',
            'total_fee' => '总价',
            'discount_fee' => '优惠金额',
            'amount' => '合计',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return OrderItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderItemQuery(get_called_class());
    }

    public function getProductImgUrl()
    {
        return Url::to(['admin/order/img', 'id' => $this->id]);
    }
}
