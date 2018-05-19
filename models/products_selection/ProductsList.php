<?php

namespace app\models\products_selection;

use Yii;
use app\models\products\Products;


class ProductsList
{
    CONST SEPARATOR = "_";
    public $attributeLabels = [];
    private $attributes = [
            'id', 'name_id', 'supplier_id', 'art', 'size', 'weight', 'price_sell', 'store_id'
        ];
    private $session;
    private $session_key;
    public $selection_mode, $invoice_id;

    public function __construct($selection_mode, $invoice_id)
    {
        $this->selection_mode = $selection_mode;
        $this->invoice_id = $invoice_id;

        $this->setAttributeLabels($this->attributes);
        $this->session = Yii::$app->session;
        if (!$this->session->isActive) {
            $this->session->open();
        }
        $this->session_key = "productsSelection" . self::SEPARATOR .
            $this->selection_mode . self::SEPARATOR .
            $this->invoice_id;
    }

    public function mergeWithProductsFound(array $productsFound) {

        $products = [];
        foreach ($productsFound as $product) {
            $products[] = $this->productDataToArr($product);
        }

        $productsSelection = $this->get();

        if (!empty($productsSelection)) {
            $products = array_merge($productsSelection, $products);
        }

        return $products;
    }

    public function get() {
        $productsSelection = $this->session->get($this->session_key, null);
        $productsSelection = ($productsSelection) ?? [];
        return $productsSelection;
    }

    public function set($productsSelection) {
        $this->session->set($this->session_key, $productsSelection);
    }

    public function searchProductsForTransfer(array $searchParams, $store_id)
    {
        $skipIds = $this->getSelectedIds();
        $searchParams = array_diff($searchParams, array(''));
        $productsArr = Products::find()->where($searchParams)
            ->andFilterWhere(['not in', 'id', $skipIds])
            ->andWhere(['<>', 'store_id', $store_id])
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
        $arr = $this->get();
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
            $productsSelection = $this->get();

            $productsSelection[] = $productArr;
            $this->set($productsSelection);
        }
    }

    public function delProduct($id) {
        if ($id) {
            $productsSelection = $this->get();
            foreach ($productsSelection as $k => $product) {
                if ($product['id'] == $id) unset($productsSelection[$k]);
            }
            $this->set($productsSelection);
        }
    }

    public function clear() {
        $this->session->remove($this->session_key);
    }

}