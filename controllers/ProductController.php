<?php

namespace app\controllers;

use app\models\products_procurement\ProductsPricingForm;
use app\models\products_procurement\InvoiceProcurement;
use app\models\products_selection\ProductsList;
use app\models\products_selection\SearchForm;
use Yii;
use app\models\products\ProductsTmp;
use app\models\products\Products;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Class ProductController
 * @package app\controllers
 */
class ProductController extends Controller
{
    CONST productNamespace = "app\models\\products\\";
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    public function actionCreate() {
        if (Yii::$app->request->isAjax && Yii::$app->request->isPost) {
            $user_id = Yii::$app->user->id;
            $outData = [];
            $post = Yii::$app->request->post();

            $productModel = (isset($post['Products'])) ? 'Products' : 'ProductsTmp';
            $newRecord = (empty($post[$productModel]['id'])) ? true : false;

            // processing of the list of products
            if ($newRecord && isset($post['ProductsTmp']['count-prod']) && (int)$post['ProductsTmp']['count-prod'] > 1 ) {

                $count = (int)$post['ProductsTmp']['count-prod'];

                /**@todo доработать */
                if ($count >= 300) {
                    return json_encode(['error' => true, 'data' => null]);
                }

                unset($post['ProductsTmp']['count-prod']);
                for($i = 1; $i <= $count; $i++) {
                    $product = new ProductsTmp();
                    $product->load($post);
                    $product->user_id = $user_id;
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
                if (!$newRecord) {
                    $product = (self::productNamespace . $productModel)::findOne($post[$productModel]['id']);
                } else {
                    $product = new ProductsTmp();
                }

                $product->load($post);
                if ($newRecord) {
                    $product->user_id = $user_id;
                }
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

    public function actionUpdateForm($product_id, $store_type_id) {
        $prodModel = ($store_type_id == 1) ? "ProductsTmp" : "Products";
        $product = (self::productNamespace . $prodModel)::findOne($product_id);
        return $this->renderAjax('create_form', [
            'product' => $product
        ]);
    }

    public function actionDelete($product_id, $store_type_id) {
        /**
         * @todo нужны проверочки
         */
        $prodModel = ($store_type_id == 1) ? "ProductsTmp" : "Products";
        $product = (self::productNamespace . $prodModel)::findOne($product_id);
        if ($product->delete()) {
            return json_encode(['error' => false, 'data' => ['id' => $product_id]]);
        }
        return json_encode(['error' => true]);
    }

    public function actionTransferFromTmpStore() {
        if (!Yii::$app->request->isAjax || !Yii::$app->request->isPost) {
            return json_encode(['error' => true]);
        }
        $store_id = Yii::$app->request->getBodyParam('store_id');
        $invoice_id = Yii::$app->request->getBodyParam('invoice_id');
        if (!$store_id || !$invoice_id) {
            return json_encode(['error' => true]);
        }

        $productsTmp = ProductsTmp::find()->where(['invoice_procur_id' => $invoice_id])->asArray()->all();
        foreach ($productsTmp as $productTmp) {
            $product = new Products();
            $product->setAttributes($productTmp);
            $product->setAttribute('store_id', $store_id);
            if (!$product->save()) {
                return json_encode(['error' => true, 'errors' => $product->getErrors()]);
            }
            ProductsTmp::deleteAll(['id' => $productTmp['id']]);
        }
        $count = count($productsTmp);
        return json_encode(['error' => false, 'data' => ['count' => $count]]);


    }

    public function actionPricing() {
        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException();
        }
        $post = Yii::$app->request->post();
        $formPricing = new ProductsPricingForm();

        $formPricing->load($post);

        if (!$formPricing->validate()) {
            throw new BadRequestHttpException();
        }

        $invoiceProcurement = InvoiceProcurement::findOne($formPricing->procurement_id);
        $products = $invoiceProcurement->products;
        if (!count($products)) {
            Yii::$app->session->setFlash('msgError', "Изделий для наценки не найдено.");
        } else {
            foreach ($products as $product) {
                switch ($formPricing->pricing_method) {
                    case 0:
                        $product->price_sell = round($product->price_procur * $formPricing->coefficient);
                        $product->save();
                        break;
                    case 1:
                        $product->price_sell = round($product->weight * $formPricing->coefficient);
                        $product->save();
                        break;
                }
            }
        }

        return $this->redirect(['invoice-procurement/' . $invoiceProcurement->id]);
    }

    /**
     * поиск и отбор продуктов
     */
    public function actionSelection() {
        $searchForm = new SearchForm();
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $searchForm->load($post);
            if ($searchForm->validate()) {
                $productsList = new ProductsList();
                $productsArr = $productsList->searchProducts($searchForm->getAttributes());
                $productsList->update($productsArr, $searchForm->id);
            }
        }

        return $this->render('products_selection/index',
            [
                'searchForm' => $searchForm
            ]
        );

    }
}