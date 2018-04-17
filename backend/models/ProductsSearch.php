<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Products;

/**
 * ProductsSearch represents the model behind the search form of `frontend\models\Products`.
 */
class ProductsSearch extends Products
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'qty', 'typebuy_id', 'typeproduct_tpid', 'unit', 'user_id'], 'integer'],
            [['pname', 'datetimeadd', 'detials', 'map', 'pic'], 'safe'],
            [['price'], 'number'],
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
        $query = Products::find();

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
            'pid' => $this->pid,
            'price' => $this->price,
            'qty' => $this->qty,
            'datetimeadd' => $this->datetimeadd,
            'typebuy_id' => $this->typebuy_id,
            'typeproduct_tpid' => $this->typeproduct_tpid,
            //'unit_uid' => $this->unit_uid,
            'user_id' => Yii::$app->user->identity->id,
        ]);

        $query->andFilterWhere(['like', 'pname', $this->pname])
            ->andFilterWhere(['like', 'detials', $this->detials])
                ->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'map', $this->map])
            ->andFilterWhere(['like', 'pic', $this->pic]);

        return $dataProvider;
    }
}
