<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Buy;

/**
 * BuySearch represents the model behind the search form of `backend\models\Buy`.
 */
class BuySearch extends Buy
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bid', 'products_id', 'status', 'user_id'], 'integer'],
            [['pricein'], 'number'],
            [['datetimeabuy', 'map'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Buy::find();

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
// 0 รอติดต่อกลับ
         // 1 รอโอนเงิน
         // 2 จัดส่งแล้ว
         // 3 ถูกขายไปแล้ว
         
        // grid filtering conditions
        $query->andFilterWhere([
            'bid' => $this->bid,
            'pricein' => $this->pricein,
            'datetimeabuy' => $this->datetimeabuy,
            'products_id' => $this->products_id,
              'bqty' => $this->bqty,
            'status' => 0,
              //['!=', 'products.pstatus', 2],
            //['!=', 'products.pstatus', 3],
            
            'user_id' => $this->user_id,
        ]);
        $query->joinWith('products');
 //$query->andFilterWhere(['!=', 'pstatus', 2,]);
 //$query->andFilterWhere(['!=', 'pstatus', 3,]); 
$query->addOrderBy(['pricein' => SORT_DESC,'datetimeabuy' => SORT_ASC]);

        //$query->andFilterWhere(['like', 'map', $this->map]);

        return $dataProvider;
    }
}
