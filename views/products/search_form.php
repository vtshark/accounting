<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $searchForm \app\models\products\SearchForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$stores_arr = ArrayHelper::map(\app\models\Stores::getAll(), 'id', 'name');

?>

    <?php $form = ActiveForm::begin([
        'id' => 'search-products-form',
        //'options' => ['class' => 'panel1'],
        'method' => 'get',
        'layout' => 'inline'
    ]); ?>

    <?=
    $form->field($searchForm, 'store_id')->dropDownList($stores_arr,
        [
            'prompt' => '',
            'inputTemplate' => '<div class="input-group"><span class="input-group-addon">@</span>{input}</div>'
        ]
        );
    ?>

    <?= $form->field($searchForm, 'id',
    [
        'horizontalCssClasses' => [
            'wrapper' => 'col-sm-2',
        ]
    ]
    )->textInput() ?>

    <?= $form->field($searchForm, 'art',
    [
        'horizontalCssClasses' => [
            'wrapper' => 'col-sm-2',
        ]
    ]
    )->textInput() ?>

    <?= $form->field($searchForm, 'weight')->textInput() ?>

    <?= $form->field($searchForm, 'size')->textInput() ?>

    <?= $form->field($searchForm, 'price_sell')->textInput() ?>

    <?= $form->field($searchForm, 'name_id')->dropDownList(
        ArrayHelper::map(\app\models\ProdNames::getAll(), 'id', 'name'),
        ['prompt' => '']);?>

    <?= $form->field($searchForm, 'category_id')->dropDownList(
        ArrayHelper::map(\app\models\ProdCategory::getAll(), 'id', 'name'),
        ['prompt' => '']);?>

    <?= $form->field($searchForm, 'supplier_id')->dropDownList(
        ArrayHelper::map(\app\models\Suppliers::getAll(), 'id', 'name_short'),
        ['prompt' => '']);?>

    <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    <?php ActiveForm::end(); ?>


