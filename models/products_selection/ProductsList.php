<?php

namespace app\models\products_selection;

use Yii;
use app\models\products\Products;


class ProductsList
{
    public $attributeLabels = [];
    private $attributes = [
            'id', 'name_id', 'supplier_id', 'art', 'size', 'weight', 'price_sell', 'store_id'
        ];
    private $session;

    public function __construct()
    {
        $this->setAttributeLabels($this->attributes);
        $this->session = Yii::$app->session;
        if (!$this->session->isActive) {
            $this->session->open();
        }
    }

    public function mergeWithProductsFound(array $productsFound) {

        $products = [];
        foreach ($productsFound as $product) {
            $products[] = $this->productDataToArr($product);
        }

        $productsSelection = $this->session->get('productsSelection', null);

        if (!empty($productsSelection)) {
            $products = array_merge($productsSelection, $products);
        }

        return $products;
    }

    public function get() {
        return $this->session->get('productsSelection', null);
    }

    public function searchProducts(array $searchParams)
    {
        $skipIds = $this->getSelectedIds();
        $searchParams = array_diff($searchParams, array(''));
        $productsArr = Products::find()->where($searchParams)
            ->andFilterWhere(['not in', 'id', $skipIds])
            ->with(['prodName', 'store', 'manufacturer', 'supplier'])
            ->all();
        return $productsArr;
    }

    public function setAttributeLabels($attributes) {
        $product = new Products();
        foreach ($attributes as $attribute) {
            $this->attributeLabels['data'][$attribute] = $product->getAttributeLabel($attribute);
        }
        $this->attributeLabels['info'] = ['#' => 0, 'check' => 0];
    }

    public function getAttributeLabels() {
        return $this->attributeLabels;
    }

    public function productDataToArr($product) {
        return  [
            'id' => $product->id,
            'name_id' => $product->prodName->name,
            'supplier_id' => $product->supplier->name_short,
            'art' => $product->art,
            'size' => $product->size,
            'weight' => $product->weight,
            'price_sell' => $product->price_sell,
            'store_id' => $product->store->name
        ];
    }

    public function getSelectedIds() {
        $arr = $this->session->get('productsSelection', null);
        if (!$arr) return null;
        $out = [];
        foreach ($arr as $item) {
            $out[] = $item['id'];
        }
        return $out;
    }

    public function addProduct($id) {
        $product = Products::findOne($id);
        if ($product) {
            $productArr = $this->productDataToArr($product);
            $productArr['check'] = true;
            $productsSelection = $this->session->get('productsSelection', null);
            $productsSelection[] = $productArr;
            $this->session->set('productsSelection', $productsSelection);
        }
    }

    public function delProduct($id) {
        if ($id) {
            $productsSelection = $this->session->get('productsSelection', null);
            foreach ($productsSelection as $k => $product) {
                if ($product['id'] == $id) unset($productsSelection[$k]);
            }
            $this->session->set('productsSelection', $productsSelection);
        }
    }

}