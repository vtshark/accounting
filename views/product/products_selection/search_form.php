<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $searchForm \app\models\products_selection\SearchForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Отбор изделий';
$this->params['breadcrumbs'][] = $this->title;

?>

    <?php $form = ActiveForm::begin([
        'id' => 'select-products-form',
        'options' => ['class' => 'panel1'],
    ]); ?>

    <?= $form->field($searchForm, 'store_id')->dropDownList(
        ArrayHelper::map(\app\models\Stores::getAll(), 'id', 'name'),
        ['prompt' => '']);?>

    <?= $form->field($searchForm, 'id')->textInput() ?>

    <?= $form->field($searchForm, 'art')->textInput() ?>

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


