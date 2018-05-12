<?
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>

<? $form = ActiveForm::begin([
    'id' => 'invoice-transfer-form',
    //'layout' => 'horizontal',
    'action' => '/invoice-transfer/create',
]); ?>

<?//= $form->field($invoiceTransfer, 'id')->textInput(); ?>
<?= $form->field($invoiceTransfer, 'store_id')->dropDownList($storesArray, ['prompt' => '']);?>
<?= $form->field($invoiceTransfer, 'description')->textInput();?>
<?= Html::submitButton('Создать накладную', ['class' => 'btn btn-success']); ?>

<?php ActiveForm::end(); ?>
