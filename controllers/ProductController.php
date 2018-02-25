<?php

namespace app\controllers;

use app\models\Products;
use yii\web\Controller;

/**
 * Class ProductController
 * @package app\controllers
 */
class ProductController extends Controller
{
    public function actionCreate() {
        if (\Yii::$app->request->isAjax && \Yii::$app->request->isPost) {
            $post = \Yii::$app->request->post();
            if (empty($post['Products']['id'])) {
                $product = new Products();
                $newRecord = true;
            } else {
                $product = Products::findOne($post['Products']['id']);
                $newRecord = false;
            }
            $product->load($post);

            if (!$product->save()) {
                return json_encode(['error' => true, 'data' => $product->getErrors()]);
            } else {
                return json_encode(['error' => false, 'data' => self::prepareDataToTable($product), 'newRecord' => $newRecord]);
            }
        }
        return json_encode(['error' => true, 'data' => null]);
    }

    /**
     * @param Products $product
     * @return array
     */
    public static function prepareDataToTable(Products $product) {
        return [
            'id' => $product->id,
            'manufacturer' => $product->manufacturer->name,
            'name' => $product->prodName->name,
            //'size' => $product->size,
            'art' => $product->art,
            'weight' => $product->weight,
            'price_procur' => $product->price_procur,
            'price_sell' => $product->price_sell,
            'branch' => $product->branch->name,
            'probe' => $product->probe,
        ];
    }

    public function actionUpdateForm($product_id) {
        $product = Products::findOne($product_id);
        return $this->renderAjax('create_form', [
            'product' => $product
        ]);
    }

    public function actionDelete($product_id) {
        /**
         * @todo нужны проверочки
         */
        $product = Products::findOne($product_id);
        if ($product->delete()) {
            return json_encode(['error' => false, 'data' => ['id' => $product_id]]);
        }
        return json_encode(['error' => true]);
    }
}