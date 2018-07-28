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
    public $date_transfer_invoice, $date_procur_invoice, $date_sales_invoice;
    public $date_transfer_d1, $date_transfer_d2;
    public $date_procur_d1, $date_procur_d2;
    public $date_sales_d1, $date_sales_d2;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name_id', 'supplier_id', 'manufacturer_id', 'store_id', 'price_sell', 'probe', 'category_id',
            'date_transfer_invoice', 'date_procur_invoice', 'date_sales_invoice'
            ], 'integer'],
            [
                ['date_transfer_d1', 'date_transfer_d2',
                    'date_procur_d1', 'date_procur_d2',
                    'date_sales_d1', 'date_sales_d2',
                ],
                'string'
            ],
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
        //echo "<pre>" . print_r( $this,1) . "</pre>"; die;
        $query = Products::find();
        $query->joinWith(['transferInvoice', 'procurementInvoice', 'salesInvoice']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]]
        ]);
        $dataProvider->sort->attributes['date_transfer_invoice'] = [
            'asc' => ['invoice_transfer.created_at' => SORT_ASC],
            'desc' => ['invoice_transfer.created_at' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['date_procur_invoice'] = [
            'asc' => ['invoice_procurement.created_at' => SORT_ASC],
            'desc' => ['invoice_procurement.created_at' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['date_sales_invoice'] = [
            'asc' => ['invoice_sales.created_at' => SORT_ASC],
            'desc' => ['invoice_sales.created_at' => SORT_DESC],
        ];

        //$this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'products.id' => $this->id,
            'products.name_id' => $this->name_id,
            'products.supplier_id' => $this->supplier_id,
            'products.manufacturer_id' => $this->manufacturer_id,
            'products.store_id' => $this->store_id,
            'products.size' => $this->size,
            'products.weight' => $this->weight,
            'products.art' => $this->art,
            'products.price_sell' => $this->price_sell,
            'products.category_id' => $this->category_id,
        ]);

        if ($this->date_transfer_d1 && $this->date_transfer_d2) {
            $d1 = strtotime($this->date_transfer_d1);
            $d2 = strtotime($this->date_transfer_d2);
            if ($d1 == $d2) {
                $d2 = strtotime($this->date_transfer_d1 . "+1 day");
            }
            $query->andFilterWhere(['>=', 'invoice_transfer.created_at', $d1])
                ->andFilterWhere(['<=', 'invoice_transfer.created_at', $d2]);
        }

        if ($this->date_procur_d1 && $this->date_procur_d2) {
            $d1 = strtotime($this->date_procur_d1);
            $d2 = strtotime($this->date_procur_d2);
            if ($d1 == $d2) {
                $d2 = strtotime($this->date_procur_d1 . "+1 day");
            }
            $query->andFilterWhere(['>=', 'invoice_procurement.created_at', $d1])
                ->andFilterWhere(['<=', 'invoice_procurement.created_at', $d2]);
        }

        if ($this->date_sales_d1 && $this->date_sales_d2) {
            $d1 = strtotime($this->date_sales_d1);
            $d2 = strtotime($this->date_sales_d2);
            if ($d1 == $d2) {
                $d2 = strtotime($this->date_sales_d1 . "+1 day");
            }
            $query->andFilterWhere(['>=', 'invoice_sales.created_at', $d1])
                ->andFilterWhere(['<=', 'invoice_sales.created_at', $d2]);
        }

        $query->with(['prodName', 'supplier', 'manufacturer', 'store', 'category']);
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
        if (isset($params['procurement_invoice_id'])) {
            $query->andWhere([
                'invoice_procur_id' => $params['procurement_invoice_id'],
            ]);
        }
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

        if (!$this->validate() || empty($params['transfer_invoice_id'])) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        if (isset($params['transfer_invoice_id'])) {
            $query->andWhere([
                'invoice_transfer_id' => $params['transfer_invoice_id'],
            ]);
        }
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
