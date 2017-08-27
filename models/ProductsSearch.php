<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Products;

/**
 * ProductsSearch represents the model behind the search form about `app\models\Products`.
 */
class ProductsSearch extends Products
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name_id', 'supplier_id', 'manufacturer_id', 'branch_id', 'size_id', 'price_sell'], 'integer'],
            [['weight', 'price_procur'], 'double'],
            [['art'], 'string'],
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
            'id' => $this->id,
            'name_id' => $this->name_id,
            'supplier_id' => $this->supplier_id,
            'manufacturer_id' => $this->manufacturer_id,
            'branch_id' => $this->branch_id,
            'size_id' => $this->size_id,
            'art' => $this->art,
        ]);
        $query->with(['name', 'manufacturer', 'size', 'branch']);

        return $dataProvider;
    }

    public function searchProcurement($params)
    {
        $query = Products::find();
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
        $query->andWhere([
            'invoice_procur_id' => $params['procurement_invoice_id'],
        ]);
        $query->andFilterWhere([
            'id' => $this->id,
            'name_id' => $this->name_id,
            'supplier_id' => $this->supplier_id,
            'manufacturer_id' => $this->manufacturer_id,
            'branch_id' => $this->branch_id,
            'size_id' => $this->size_id,
            'art' => $this->art,
        ]);

        $query->with(['name', 'manufacturer', 'size', 'branch']);

        return $dataProvider;
    }



    public static function getTotal($provider, $fieldName) {
        $total = 0;
        foreach ($provider as $item) {
            $total += $item[$fieldName];
        }
        return $total;
    }
}
