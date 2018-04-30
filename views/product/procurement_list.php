<?php
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
// по умолчанию используется тип "склад"
$store_type_id = Yii::$app->request->get('store_type') ?: 2;
?>
<? Pjax::begin(['id' => 'products_list', 'enablePushState' => false]); ?>
<?= GridView::widget([
    'tableOptions' => [
        'id' => 'products_table',
        'class' => 'table table-bordered',
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
        [
            'attribute' => 'size',
            'headerOptions' => ['style' => 'width:60px;'],
            'filter' => ArrayHelper::map(\app\models\Sizes::getAll(), 'size', 'size')
        ],
        'art',
        [
            'attribute' => 'weight',
            'headerOptions' => ['style' => 'width:60px;'],
            'footer' => \app\models\ProductsSearch::getTotal($dataProvider->models, 'weight'),
        ],
        [
            'attribute' => 'price_procur',
            'headerOptions' => ['style' => 'width:80px;'],
            'footer' => \app\models\ProductsSearch::getTotal($dataProvider->models, 'price_procur'),
        ],
        [
            'attribute' => 'price_sell',
            'headerOptions' => ['style' => 'width:80px;'],
            'footer' => \app\models\ProductsSearch::getTotal($dataProvider->models, 'price_sell'),
        ],
        [
            'attribute' => 'store_id',
            'headerOptions' => ['style' => 'width:100px;'],
            'filter' => ArrayHelper::map(\app\models\Stores::getAll(), 'id', 'name'),
            'value' => function($data) {
                return $data->store->name;
            }
        ],

        [
            'attribute' => 'category_id',
            'headerOptions' => ['style' => 'width:100px;'],
            'filter' => ArrayHelper::map(\app\models\ProdCategory::getAll(), 'id', 'name'),
            'value' => function($data) {
                return $data->category->name;
            }
        ],

        [
            'attribute' => 'probe',
            'headerOptions' => ['style' => 'width:60px;'],
            'filter' => ArrayHelper::map(\app\models\Probe::getAll(), 'id', 'id'),
            'value' => function($data) {
                return ($data->probe == 0) ? '' : $data->probe;
            }
        ],

        [
            'class' => \yii\grid\ActionColumn::className(),
            'buttons' => [
                'update' => function ($url, $model) use($store_type_id) {
                    $customUrl = Yii::$app->getUrlManager()->createUrl(['product/update-form/' . $model['id'] . '/' . $store_type_id]);
                    return \yii\helpers\Html::a(
                        '<span class="glyphicon glyphicon-pencil edit-product" data-href="' . $customUrl . '"></span>', "",
                        ['title' => 'Корректировать']);
                },
                'delete' => function ($url, $model) use($store_type_id) {
                    $customUrl = Yii::$app->getUrlManager()->createUrl(['product/delete/' . $model['id'] . '/' . $store_type_id]);
                    return \yii\helpers\Html::a(
                        '<span class="glyphicon glyphicon-trash del-product" data-href="' . $customUrl . '"></span>', "",
                        ['title' => 'Удалить']);
                }
            ],
            'template' => '{update} {delete}'
        ],
    ],
]); ?>
<?php Pjax::end(); ?>
