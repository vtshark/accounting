<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $searchForm \app\models\products_selection\SearchForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$stores_arr = ArrayHelper::map(\app\models\Stores::getAll(), 'id', 'name');
unset($stores_arr[$invoiceTransfer->store_id]);
$selection_mode = Yii::$app->request->getQueryParam('selection_mode');
$invoice_id = Yii::$app->request->getQueryParam('invoice_id');
?>

    <?php $form = ActiveForm::begin([
        'id' => 'select-products-form',
        'options' => ['class' => 'panel1'],
        'method' => 'get',
        'action' => Url::to(['product/selection/' . $selection_mode . '-' . $invoice_id])
    ]); ?>

    <?= $form->field($searchForm, 'store_id')->dropDownList($stores_arr, ['prompt' => '']);?>

    <?= $form->field($searchForm, 'id') ?>

    <?= $form->field($searchForm, 'auto_check')->checkbox() ?>

    <hr>

    <?= $form->field($searchForm, 'art') ?>

    <?= $form->field($searchForm, 'weight') ?>

    <?= $form->field($searchForm, 'size') ?>

    <?= $form->field($searchForm, 'price_sell') ?>

    <?= $form->field($searchForm, 'name_id')->dropDownList(
        ArrayHelper::map(\app\models\ProdNames::getAll(), 'id', 'name'),
        ['prompt' => '']);?>

    <?= $form->field($searchForm, 'category_id')->dropDownList(
        ArrayHelper::map(\app\models\ProdCategory::getAll(), 'id', 'name'),
        ['prompt' => '']);?>

    <?= $form->field($searchForm, 'supplier_id')->dropDownList(
        ArrayHelper::map(\app\models\Suppliers::getAll(), 'id', 'name_short'),
        ['prompt' => '']);?>

    <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end(); ?>


