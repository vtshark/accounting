<?
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>

<? $form = ActiveForm::begin([
    'id' => 'invoice-procurement-form',
    //'layout' => 'horizontal',
    'action' => '/invoice-procurement/create',
//        'fieldConfig' => [
//            'template' => "<div class=\"col-xs-12 col-sm-6 right\">{label}</div>
//                            \n<div class=\"col-xs-12 col-sm-6 left\">{input}</div>
//                            \n<div class=\"col-xs-12 col-sm-6\">{error}</div>",
//            'labelOptions' => ['class' => 'col-lg-1 control-label'],
//        ]
]); ?>

<?//= $form->field($invoiceProcurement, 'id')->textInput(); ?>
<?= $form->field($invoiceProcurement, 'supplier_id')->dropDownList($suppliersArray, ['prompt' => '']);?>
<?= $form->field($invoiceProcurement, 'description')->textInput();?>
<?= Html::submitButton('Создать накладную', ['class' => 'btn btn-success']); ?>

<?php ActiveForm::end(); ?>
