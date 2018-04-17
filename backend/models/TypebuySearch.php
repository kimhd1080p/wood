<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Typebuy;

/**
 * TypebuySearch represents the model behind the search form of `backend\models\Typebuy`.
 */
class TypebuySearch extends Typebuy
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tbid'], 'integer'],
            [['tbname'], 'safe'],
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
        $query = Typebuy::find();

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
            'tbid' => $this->tbid,
        ]);

        $query->andFilterWhere(['like', 'tbname', $this->tbname]);

        return $dataProvider;
    }
}
