<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Order;

/**
 * OrderSearch represents the model behind the search form of `app\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'type', 'time', 'paytime', 'refund_state', 'refund_type', 'refund_time'], 'integer'],
            [['order_no', 'fixed_reason', 'seller_message', 'wx_transaction_id', 'trade_no', 'vendor', 'receiver_name', 'receiver_phone', 'receiver_state', 'receiver_city', 'receiver_district', 'receiver_address', 'buyer_nickname', 'openid', 'buyer_message', 'refund_reason', 'raw'], 'safe'],
            [['total_fee', 'discount_fee', 'postage', 'fixed_fee', 'coin_fee', 'amount', 'refund_fee'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Order::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'type' => $this->type,
            'total_fee' => $this->total_fee,
            'discount_fee' => $this->discount_fee,
            'postage' => $this->postage,
            'fixed_fee' => $this->fixed_fee,
            'coin_fee' => $this->coin_fee,
            'amount' => $this->amount,
            'time' => $this->time,
            'paytime' => $this->paytime,
            'refund_state' => $this->refund_state,
            'refund_type' => $this->refund_type,
            'refund_fee' => $this->refund_fee,
            'refund_time' => $this->refund_time,
        ]);

        $query->andFilterWhere(['like', 'order_no', $this->order_no])
            ->andFilterWhere(['like', 'fixed_reason', $this->fixed_reason])
            ->andFilterWhere(['like', 'seller_message', $this->seller_message])
            ->andFilterWhere(['like', 'wx_transaction_id', $this->wx_transaction_id])
            ->andFilterWhere(['like', 'trade_no', $this->trade_no])
            ->andFilterWhere(['like', 'vendor', $this->vendor])
            ->andFilterWhere(['like', 'receiver_name', $this->receiver_name])
            ->andFilterWhere(['like', 'receiver_phone', $this->receiver_phone])
            ->andFilterWhere(['like', 'receiver_state', $this->receiver_state])
            ->andFilterWhere(['like', 'receiver_city', $this->receiver_city])
            ->andFilterWhere(['like', 'receiver_district', $this->receiver_district])
            ->andFilterWhere(['like', 'receiver_address', $this->receiver_address])
            ->andFilterWhere(['like', 'buyer_nickname', $this->buyer_nickname])
            ->andFilterWhere(['like', 'openid', $this->openid])
            ->andFilterWhere(['like', 'buyer_message', $this->buyer_message])
            ->andFilterWhere(['like', 'refund_reason', $this->refund_reason])
            ->andFilterWhere(['like', 'raw', $this->raw]);

        return $dataProvider;
    }
}
