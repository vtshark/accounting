<?php

namespace app\models\products;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

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
            [['id', 'name_id', 'supplier_id', 'manufacturer_id', 'store_id', 'price_sell', 'probe', 'category_id'], 'integer'],
            [['weight', 'size', 'price_procur'], 'double'],
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
            $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'name_id' => $this->name_id,
            'supplier_id' => $this->supplier_id,
            'manufacturer_id' => $this->manufacturer_id,
            'store_id' => $this->store_id,
            'size' => $this->size,
            'art' => $this->art,
        ]);
        $query->with(['prodName', 'manufacturer', 'store']);

        return $dataProvider;
    }

    public function searchProcurement($params)
    {
        $query = parent::find();
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
            $query->where('0=1');
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
            'store_id' => $this->store_id,
            'size' => $this->size,
            'art' => $this->art,
            'weight' => $this->weight,
            'probe' => $this->probe,
            'category_id' => $this->category_id,
            'price_sell' => $this->price_sell,
            'price_procur' => $this->price_procur,
        ]);
        if (parent::hasProperty("user_id")) {
            $query->andFilterWhere(['user_id' => Yii::$app->user->id]);
        }

        $query->with(['prodName', 'manufacturer', 'store', 'category']);

        return $dataProvider;
    }

    public function searchTransfer($params)
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

        if (!$this->validate() || !$params['transfer_invoice_id']) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andWhere([
            'invoice_transfer_id' => $params['transfer_invoice_id'],
        ]);
        $query->andFilterWhere([
            'id' => $this->id,
            'name_id' => $this->name_id,
            'supplier_id' => $this->supplier_id,
            'manufacturer_id' => $this->manufacturer_id,
            'store_id' => $this->store_id,
            'size' => $this->size,
            'art' => $this->art,
            'weight' => $this->weight,
            'price_sell' => $this->price_sell,
        ]);

        $query->with(['prodName', 'manufacturer', 'store']);

        return $dataProvider;
    }

    /**
     * @param $provider
     * @param $fieldName
     * @return int
     */
    public static function getTotal($provider, $fieldName) {
        $total = 0;
        foreach ($provider as $item) {
            $total += $item[$fieldName];
        }
        return $total;
    }
}
