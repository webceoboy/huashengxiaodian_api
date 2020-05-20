<?php

use yii\db\Migration;

/**
 * Class m200515_151924_init
 */
class m200515_151924_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(10),
            'order_no' => $this->string(64)->notNull()->comment('订单号'),
            'status' => $this->tinyInteger(2)->notNull()->comment('状态'),
            'type' => $this->tinyInteger(2)->notNull()->comment('类型'),
            'total_fee' => $this->decimal(10, 2)->defaultValue(0)->comment('总价'),
            'discount_fee' => $this->decimal(10, 2)->defaultValue(0)->comment('优惠'),
            'postage' => $this->decimal(10, 2)->defaultValue(0)->comment('邮费'),
            'fixed_fee' => $this->decimal(10, 2)->defaultValue(0)->comment('改价'),
            'fixed_reason' => $this->string(64)->null()->comment('改价理由'),
            'coin_fee' => $this->decimal(10, 2)->defaultValue(0)->comment('花生米'),
            'amount' => $this->decimal(10, 2)->defaultValue(0)->comment('合计'),
            'seller_message' => $this->string(128)->null()->comment('卖家备注'),
            'time' => $this->integer(10)->notNull()->comment('下单时间'),
            'paytime' => $this->integer(10)->null()->comment('支付时间'),
            'wx_transaction_id' => $this->string(64)->null()->comment('微信流水号'),
            'trade_no' => $this->string(64)->notNull()->comment('流水'),
            'vendor' => $this->string(64)->null()->comment('渠道'),
            'receiver_name' => $this->string(32)->null()->comment('收件人'),
            'receiver_phone' => $this->string(32)->null()->comment('收件人电话'),
            'receiver_state' => $this->string(12)->null()->comment('收件人省份'),
            'receiver_city' => $this->string(16)->null()->comment('收件人城市'),
            'receiver_district' => $this->string(16)->null()->comment('收件人区域'),
            'receiver_address' => $this->string(64)->null()->comment('收件人地址'),
            'buyer_nickname' => $this->string(32)->null()->comment('买家微信'),
            'openid' => $this->string(64)->null()->comment('买家open id'),
            'buyer_message' => $this->string(64)->null()->comment('买家备注'),
            'refund_state' => $this->tinyInteger(2)->null()->comment('退款状态'),
            'refund_type' => $this->tinyInteger(2)->null()->comment('退款类型'),
            'refund_fee' => $this->decimal(10, 2)->defaultValue(0)->comment('退款'),
            'refund_reason' => $this->string(128)->null()->comment('退款理由'),
            'refund_time' => $this->integer(10)->null()->comment('退款时间'),
            'raw' => $this->text(),
        ]);
        $this->createTable('order_item', [
            'id' => $this->primaryKey(10),
            'order_id' => $this->integer()->notNull(),
            'title' => $this->string(64)->null()->comment('商品'),
            'post_id' => $this->string(16)->notNull()->comment('商品id'),
            'image_url' => $this->string(256)->null()->comment('商品图片'),
            'product_no' => $this->string(64)->null()->comment('商品编码'),
            'sku_id' => $this->string(64)->null()->comment('sku_id'),
            'sku_property_names' => $this->string(128)->null()->comment('属性'),
            'quantity' => $this->integer(10)->defaultValue(0)->comment('数量'),
            'original_price' => $this->decimal(10, 2)->defaultValue(0)->comment('原价'),
            'price' => $this->decimal(10, 2)->defaultValue(0)->comment('售价'),
            'cost' => $this->decimal(10, 2)->defaultValue(0)->comment('成本'),
            'total_fee' => $this->decimal(10, 2)->defaultValue(0)->comment('总价'),
            'discount_fee' => $this->decimal(10, 2)->defaultValue(0)->comment('优惠金额'),
            'amount' => $this->decimal(10, 2)->defaultValue(0)->comment('合计'),
            'created_at' => $this->integer(10),
            'updated_at' => $this->integer(10),
        ]);
        $this->createTable('notify', [
            'id' => $this->primaryKey(),
            'target_id' => $this->string(16),
            'created_at' => $this->integer(10),
            'updated_at' => $this->integer(10),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200515_151924_init cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200515_151924_init cannot be reverted.\n";

        return false;
    }
    */
}
