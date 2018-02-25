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
            $outData = [];

            $newRecord = (empty($post['Products']['id'])) ? true : false;

            // processing of the list of products
            if ($newRecord && isset($post['Products']['count-prod']) && (int)$post['Products']['count-prod'] > 1 ) {

                $count = (int)$post['Products']['count-prod'];

                /**@todo доработать */
                if ($count >= 300) {
                    return json_encode(['error' => true, 'data' => null]);
                }

                unset($post['Products']['count-prod']);
                for($i = 1; $i <= $count; $i++) {
                    $product = new Products();
                    $product->load($post);
                    if (!$product->save()) {
                        return json_encode(['error' => true, 'data' => $product->getErrors()]);
                    } else {
                        //return json_encode(['error' => false, 'data' => self::prepareDataToTable($product), 'newRecord' => $newRecord]);
                        $outData[] = self::prepareDataToTable($product);
                    }
                }
                return json_encode(['error' => false, 'data' => $outData, 'newRecord' => $newRecord]);

            } else {
                // processing of the single product

                $product = ($newRecord) ? new Products() : Products::findOne($post['Products']['id']);

                $product->load($post);
                if (!$product->save()) {
                    return json_encode(['error' => true, 'data' => $product->getErrors()]);
                } else {
                    $outData[] = self::prepareDataToTable($product);
                    return json_encode(['error' => false, 'data' => $outData, 'newRecord' => $newRecord]);
                }
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
            'size' => $product->size,
            'art' => $product->art,
            'weight' => $product->weight,
            'price_procur' => $product->price_procur,
            'price_sell' => $product->price_sell,
            'store' => $product->store->name,
            'category' => $product->category->name,
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