<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Probe */

$this->title = 'Create Probe';
$this->params['breadcrumbs'][] = ['label' => 'Probes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="probe-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
