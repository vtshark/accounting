<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Suppliers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="suppliers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_full')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_short')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
