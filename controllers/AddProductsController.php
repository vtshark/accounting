<?php

namespace app\controllers;

use app\models\InvoiceProcurement;
use app\models\Products;
use app\models\ProductsSearch;
use yii\web\Controller;
use Yii;

class AddProductsController extends Controller {
    public function actionIndex() {
        return $this->redirect(['/add-products/invoice']);
    }

    public function actionNewInvoice() {
        /*if (Yii::$app->user->isGuest) {
            return $this->redirect(['/account/login']); }*/
        $invoice = new InvoiceProcurement();
        $invoice->branch_id = 1;
        $invoice->user_id = 1;
        if ($invoice->save()) {
            return $this->redirect(['/add-products/invoice/' . $invoice->id]);
        } else {
            Yii::$app->session->setFlash('msgError', 'Ошибка создания новой накладной!');
            return $this->redirect(['/add-products/invoice']);
        }
    }

    public function actionInvoice($procurement_invoice_id = null) {
        $product = new Products();
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->searchProcurement(Yii::$app->request->queryParams);
        return $this->render('index',
            [
                'product' => $product,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider
            ]
        );
    }

}