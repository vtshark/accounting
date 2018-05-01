<?php

namespace app\controllers;

use app\models\forms\invoice_procurement\ApproveInvoice;
use app\models\Products;
use app\models\ProductsSearch;
use app\models\ProductsTmp;
use app\models\ProductsTmpSearch;
use app\models\StoreTypes;
use app\models\Suppliers;
use Yii;
use app\models\InvoiceProcurement;
use app\models\InvoiceProcurementSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;

class InvoiceProcurementController extends Controller
{
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
    public function actionIndex($procurement_invoice_id = null) {
        // по умолчанию используется тип "склад"
        $store_type_id = Yii::$app->request->get('store_type') ?: 2;
        $storeType = StoreTypes::findOne($store_type_id);

        if ($storeType->id == 1) {
            $searchModel = new ProductsTmpSearch();
        } else {
            $searchModel = new ProductsSearch();
        }
        $product = new ProductsTmp();

        if ($procurement_invoice_id) {
            $invoiceProcurement = InvoiceProcurement::findOne($procurement_invoice_id);
            $product->supplier_id = $invoiceProcurement->supplier_id;
            /**@todo переделать **/
            $product->store_id = 1;
            $product->invoice_procur_id = $invoiceProcurement->id;
        } else {
            $invoiceProcurement = null;
        }

        $dataProvider = $searchModel->searchProcurement(Yii::$app->request->queryParams);

        return $this->render('index',
            [
                'invoiceProcurement' => $invoiceProcurement,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'product' => $product
            ]
        );
    }

    public function actionList()
    {
        $searchModel = new InvoiceProcurementSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 5;
        return $this->renderAjax('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreateForm()
    {
        $invoiceProcurement = new InvoiceProcurement();
        $suppliersArray = ArrayHelper::map(Suppliers::find()->all(), 'id', 'name_short');
        return $this->renderAjax('create_form', [
            'invoiceProcurement' => $invoiceProcurement,
            'suppliersArray' => $suppliersArray
        ]);

    }

    public function actionCreate()
    {
        $invoiceProcurement = new InvoiceProcurement();
        $invoiceProcurement->load(Yii::$app->request->post());
        /** @TODO: убрать после создания авторизации */
        $invoiceProcurement->user_id = Yii::$app->user->id;
        if ($invoiceProcurement->save()) {
            return $this->redirect(['/invoice-procurement/' . $invoiceProcurement->id]);
        } else {
            Yii::$app->session->setFlash('msgError', 'Ошибка создания новой накладной!');
            return $this->redirect(['/invoice-procurement']);
        }
    }

    public function actionApprove()
    {
        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException();
        }
        $post = Yii::$app->request->post();
        $formApprove = new ApproveInvoice();

        $formApprove->load($post);

        if (!$formApprove->validate()) {
            throw new BadRequestHttpException();
        }
        $invoiceProcurement = InvoiceProcurement::findOne($formApprove->procurement_id);
        if (!$invoiceProcurement) {
            throw new BadRequestHttpException();
        }
        if ($invoiceProcurement->is_closed) {
            Yii::$app->session->setFlash('msgError', "Накладная уже утверждена.");
        }

        $products = $invoiceProcurement->products;
        if (!count($products)) {
            Yii::$app->session->setFlash('msgError', "Накладная не содержит изделий.");
        } else {
            foreach ($products as $product) {
                $product->prime_cost = round($product->price_procur / $formApprove->dollar_rate, 2);
                $product->scenario = Products::SCENARIO_APPROVE_INVOICE;
                $product->save();
            }

            $invoiceProcurement->is_closed = true;
            $invoiceProcurement->save();
            $invoiceProcurement->deleteTmpProducts();
        }
        return $this->redirect(['invoice-procurement/' . $invoiceProcurement->id]);

    }

}
