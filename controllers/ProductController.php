<?php

namespace app\controllers;

use app\models\products_procurement\ProductsPricingForm;
use app\models\products_procurement\InvoiceProcurement;
use app\models\products_selection\ProductsList;
use app\models\products_selection\SearchForm;
use app\models\products_transfer\InvoiceTransfer;
use Yii;
use app\models\products\ProductsTmp;
use app\models\products\Products;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\StoreTypes;

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
        $prodModel = ($store_type_id == StoreTypes::TMP_TYPE_ID) ? "ProductsTmp" : "Products";
        $product = (self::productNamespace . $prodModel)::findOne($product_id);
        return $this->renderAjax('create_form', [
            'product' => $product
        ]);
    }

    public function actionDelete($product_id, $store_type_id) {
        /**
         * @todo нужны проверочки
         */
        $prodModel = ($store_type_id == StoreTypes::TMP_TYPE_ID) ? "ProductsTmp" : "Products";
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
        if ($formPricing->store_type == StoreTypes::TMP_TYPE_ID) {
            $products = $invoiceProcurement->tmpProducts;
        } else {
            $products = $invoiceProcurement->products;
        }

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

        return $this->redirect(['invoice-procurement/' . $invoiceProcurement->id, 'store_type' => $formPricing->store_type]);
    }

    /**
     * поиск и отбор продуктов
     * @param $selection_mode
     * @param $invoice_id
     * @return string
     */
    public function actionSelection($selection_mode, $invoice_id) {
        $searchForm = new SearchForm();
        $productsList = new ProductsList($selection_mode, $invoice_id);
        $invoiceTransfer = InvoiceTransfer::findOne($invoice_id);
        $attributeLabels = $productsList->getAttributeLabels();

        $get = Yii::$app->request->get();
        $searchForm->load($get);
            if ($searchForm->validate()) {
                $productsFound = $productsList->searchProductsForTransfer($searchForm->getAttributes(), $invoiceTransfer->store_id);
                $products = $productsList->mergeWithProductsFound($productsFound);
            } else {
                $products = $productsList->get();
            }

        return $this->render('products_selection/index',
            [
                'searchForm' => $searchForm,
                'attributeLabels' => $attributeLabels,
                'products' => $products,
                'invoiceTransfer' => $invoiceTransfer
            ]
        );

    }

    public function actionClearSelect()
    {
        if (!Yii::$app->request->isAjax || !Yii::$app->request->isPost) {
            return json_encode(['error' => true]);
        }
        $post = Yii::$app->request->post();
        $selection_mode = ($post['selection_mode']) ?? null;
        $invoice_id = ($post['invoice_id']) ?? null;
        $productsList = new ProductsList($selection_mode, $invoice_id);
        $productsList->clear();

        return json_encode(['error' => false, 'data' => []]);
    }


    public function actionMultiSelect()
    {
        if (!Yii::$app->request->isAjax || !Yii::$app->request->isPost) {
            return json_encode(['error' => true]);
        }
        $post = Yii::$app->request->post();
        $selection_mode = ($post['selection_mode']) ?? null;
        $invoice_id = ($post['invoice_id']) ?? null;
        $productsList = new ProductsList($selection_mode, $invoice_id);
        $productsList->addProducts($post['ids']);

        return json_encode(['error' => false, 'data' => []]);
    }



    public function actionSelect() {
        if (!Yii::$app->request->isAjax || !Yii::$app->request->isPost) {
            return json_encode(['error' => true]);
        }
        $post = Yii::$app->request->post();

        $selection_mode = ($post['selection_mode']) ?? null;
        $invoice_id = ($post['invoice_id']) ?? null;
        $productsList = new ProductsList($selection_mode, $invoice_id);

        ($post['checked'] == "true") ? $productsList->addProduct($post['id']) : $productsList->delProduct($post['id']);

        return json_encode(['error' => false]);
    }

    public function actionConfirmSelection($selection_mode, $invoice_id) {

        $productsList = new ProductsList($selection_mode, $invoice_id);
        $invoiceTransfer = InvoiceTransfer::findOne($invoice_id);
        $list = $productsList->get();
        foreach ($list as $item) {
            $product = Products::find()->where(['id' => $item['id']])->limit(1)->one();
            $product->setAttribute('invoice_transfer_id', $invoiceTransfer->id);
            $product->setAttribute('store_id', $invoiceTransfer->store_id);
            if (!$product->save()) {
                die("error");
            }
        }
        $productsList->clear();
        return $this->redirect(['invoice-transfer/' . $invoice_id]);
    }

    public function actionDebug() {
//        $session = Yii::$app->session;
//        if (!$session->isActive) {
//            $session->open();
//        }
//        $session->remove("productsSelection_transfer_products_1");
        echo "<pre>" . print_r($_SESSION ,1) . "</pre>"; die;
    }

}