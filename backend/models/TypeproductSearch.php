<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Typeproduct;

/**
 * TypeproductSearch represents the model behind the search form of `backend\models\Typeproduct`.
 */
class TypeproductSearch extends Typeproduct
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tpid'], 'integer'],
            [['tpname'], 'safe'],
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
        $query = Typeproduct::find();

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
            'tpid' => $this->tpid,
        ]);

        $query->andFilterWhere(['like', 'tpname', $this->tpname]);

        return $dataProvider;
    }
}
