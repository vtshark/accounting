<?php
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\products\ProductsSearch;


?>
<? Pjax::begin(['id' => 'products_list', 'enablePushState' => false]); ?>
<?= GridView::widget([
    'tableOptions' => [
        'id' => 'products_table',
        'class' => 'table table-bordered table-striped',
    ],
    'rowOptions' => ['class' => 'table-row'],
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'showFooter' => true,
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
            'footer' => count($dataProvider->models),
        ],

        [
            'attribute' => 'id',
            'headerOptions' => ['style' => 'width:70px;'],
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
            'attribute' => 'name_id',
            'headerOptions' => ['style' => 'width:130px;'],
            'value' => function($data) {
                return $data->prodName->name;
            },
            'filter' => ArrayHelper::map(\app\models\ProdNames::getAll(), 'id', 'name')
        ],
        'art',
        [
            'attribute' => 'weight',
            'headerOptions' => ['style' => 'width:60px;'],
            'footer' => ProductsSearch::getTotal($dataProvider->models, 'weight'),
        ],
        [
            'attribute' => 'price_sell',
            'headerOptions' => ['style' => 'width:80px;'],
            'footer' => ProductsSearch::getTotal($dataProvider->models, 'price_sell'),
        ],
        [
            'attribute' => 'store_id',
            'headerOptions' => ['style' => 'width:100px;'],
            'filter' => ArrayHelper::map(\app\models\Stores::getAll(), 'id', 'name'),
            'value' => function($data) {
                return $data->store->name;
            }
        ],

    ],
]); ?>
<?php Pjax::end(); ?>
