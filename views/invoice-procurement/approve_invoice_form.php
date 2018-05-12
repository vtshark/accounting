<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$model = new \app\models\products_procurement\ApproveInvoiceForm();

$model->procurement_id = $procurement_id;
$form = ActiveForm::begin([
    'action' => '/invoice-procurement/approve',
]); ?>

<?= $form->field($model, 'procurement_id')->hiddenInput()->label(false);?>
<?= $form->field($model, 'dollar_rate')->textInput();?>

<?= Html::submitButton('Утвердить', ['class' => 'btn btn-success']); ?>

<?php ActiveForm::end(); ?>