<?php
use yii\grid\GridView;
use yii\widgets\Pjax;
?>
<?php Pjax::begin(['id' => 'invoice-procur-list', 'enablePushState' => false]); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    //'filterModel' => $searchModel,
    'showFooter' => true,
    'columns' => [
        //['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'id',
            'footer' => count($dataProvider->models),
        ],
        [
            'attribute' => 'manufacturer_id',
            'value' => function($data) {
                return $data->manufacturer->name;
            }
        ],
        [
            'attribute' => 'name_id',
            'value' => function($data) {
                return $data->name->name;
            }
        ],
        [
            'attribute' => 'size_id',
            'value' => function($data) {
                return $data->size->size;
            }
        ],
        'art',
        [
            'attribute' => 'weight',
            'footer' => \app\models\ProductsSearch::getTotal($dataProvider->models, 'weight'),
        ],
        [
            'attribute' => 'price_procur',
            'footer' => \app\models\ProductsSearch::getTotal($dataProvider->models, 'price_procur'),
        ],
        [
            'attribute' => 'price_sell',
            'footer' => \app\models\ProductsSearch::getTotal($dataProvider->models, 'price_sell'),
        ],
        [
            'attribute' => 'branch_id',
            'value' => function($data) {
                return $data->branch->name;
            }
        ],

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
<?php Pjax::end(); ?>
