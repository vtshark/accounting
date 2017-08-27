<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\InvoiceProcurement;

/**
 * InvoiceProcurementSearch represents the model behind the search form about `app\models\InvoiceProcurement`.
 */
class InvoiceProcurementSearch extends InvoiceProcurement
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'branch_id', 'created_at', 'user_id', 'is_closed'], 'integer'],
            [['description'], 'safe'],
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
        $query = InvoiceProcurement::find();
        if (!isset($params['sort'])) {
            $query->orderBy(['id' => SORT_DESC]);
        }
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
            'branch_id' => $this->branch_id,
            'created_at' => $this->created_at,
            'user_id' => $this->user_id,
            'is_closed' => $this->is_closed,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->with(['user', 'branch']);

        return $dataProvider;
    }
}
