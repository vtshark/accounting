<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProdCategory */

$this->title = 'Create Prod Category';
$this->params['breadcrumbs'][] = ['label' => 'Prod Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prod-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
