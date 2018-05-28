<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\products\ProductsSearch;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\products\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="products-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-bordered table-striped'
        ],
        'rowOptions' => ['class' => 'table-row'],
        'showFooter' => true,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['style' => 'width:30px;'],
                'footer' => count($dataProvider->models),
            ],

            [
                'attribute' => 'id',
                'headerOptions' => ['style' => 'width:70px;'],
            ],
            [
                'attribute' => 'name_id',
                'headerOptions' => ['style' => 'width:130px;'],
                'value' => function($data) {
                    return $data->prodName->name;
                },
                'filter' => ArrayHelper::map(\app\models\ProdNames::getAll(), 'id', 'name')
            ],
            [
                'attribute' => 'supplier_id',
                'headerOptions' => ['style' => 'width:130px;'],
                'value' => function($data) {
                    return $data->supplier->name_short;
                },
                'filter' => ArrayHelper::map(\app\models\Suppliers::getAll(), 'id', 'name_short')
            ],
            [
                'attribute' => 'manufacturer_id',
                'headerOptions' => ['style' => 'width:130px;'],
                'value' => function($data) {
                    return $data->manufacturer->name;
                },
                'filter' => ArrayHelper::map(\app\models\Manufacturers::getAll(), 'id', 'name')
            ],
            [
                'attribute' => 'size',
                'headerOptions' => ['style' => 'width:60px;'],
                'filter' => ArrayHelper::map(\app\models\Sizes::getAll(), 'size', 'size')
            ],
            [
                'attribute' => 'art',
                'headerOptions' => ['style' => 'width:150px;'],
            ],

            [
                'attribute' => 'weight',
                'headerOptions' => ['style' => 'width:60px;'],
                'footer' => ProductsSearch::getTotal($dataProvider->models, 'weight'),
            ],

            [
                'attribute' => 'date_transfer_invoice',
                'headerOptions' => ['style' => 'width:60px;'],
                'value' => function($data) {
                    $date = $data->transferInvoice->created_at;
                    $date = $date ? date("d.m.Y", $date) : "";
                    return $date;
                },
            ],

            [
                'attribute' => 'date_sales_invoice',
                'headerOptions' => ['style' => 'width:60px;'],
                'value' => function($data) {
                    $date = $data->salesInvoice->created_at;
                    $date = $date ? date("d.m.Y", $date) : "";
                    return $date;
                },
            ],
            [
                'attribute' => 'store_id',
                'value' => function($data) {
                    return $data->store->name;
                },
                'filter' => ArrayHelper::map(\app\models\Stores::getAll(), 'id', 'name')
            ],
            [
                'attribute' => 'category_id',
                'value' => function($data) {
                    return $data->category->name;
                },
                'filter' => ArrayHelper::map(\app\models\ProdCategory::getAll(), 'id', 'name'),
                'format' => 'html'
            ],
            [
                'attribute' => 'date_procur_invoice',
                'headerOptions' => ['style' => 'width:60px;'],
                'value' => function($data) {
                    $date = $data->procurementInvoice->created_at;
                    $date = $date ? date("d.m.Y", $date) : "";
                    return $date;
                },
                'filter' =>  DateRangePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'date_procur_invoice',
                    'pluginOptions' => [
                        'format' => 'd-m-Y',
                        'autoUpdateInput' => false
                    ]
                ]),
                //'format' => 'html'
            ],
            'price_sell'

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
