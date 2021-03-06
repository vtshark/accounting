<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
<!--    --><?php
//    NavBar::begin([
//        'brandLabel' =>  '<i class="far fa-gem fa-lg"></i>',
//        'brandUrl' => Yii::$app->homeUrl,
//        'options' => [
//            'class' => 'navbar-inverse navbar-fixed-top panel3',
//        ],
//    ]);
//
//    $items[] = ['label' => 'Home', 'url' => ['/site/index']];
//    if (!Yii::$app->user->isGuest) {
//        $items[] = ['label' => 'Приход', 'url' => ['/invoice-procurement'], 'active' => Yii::$app->controller->id == 'invoice-procurement'];
//        $items[] = ['label' => 'Выдача', 'url' => ['/invoice-transfer'], 'active' => Yii::$app->controller->id == 'invoice-transfer'];
//        $items[] = ['label' => 'Изделия', 'url' => ['/products'], 'active' => Yii::$app->controller->id == 'products'];
//        $items[] = ['label' => 'Админка', 'url' => ['/backend/admin-menu'], 'active' => Yii::$app->controller->id == 'admin-menu'];
//    }
//    $items[] = ['label' => 'About', 'url' => ['/site/about']];
//    $items[] = ['label' => 'Contact', 'url' => ['/site/contact']];
//    if (Yii::$app->user->isGuest) {
//        $items[] = ['label' => 'Login', 'url' => ['/login'], 'active' => Yii::$app->controller->id == 'login'];
//    } else {
//        $items[] = '<li>' . Html::beginForm(['/login/logout'], 'post')
//            . Html::submitButton(
//            'Logout (' . Yii::$app->user->identity->username . ')',
//                ['class' => 'btn btn-link logout']
//            )
//        . Html::endForm()
//        . '</li>';
//    }
//
//
//    echo Nav::widget([
//        'options' => ['class' => 'navbar-nav navbar-left'],
//        'items' => $items,
//    ]);
//    NavBar::end();
//    ?>

    <div class="container-fluid">
        <span class="inline-block">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        </span>
        <span class="pull-right">
        <?
        if (!Yii::$app->user->isGuest) {
            echo $this->render("/layouts/sidebar");
        }
        ?>
        </span>
    </div>

    <div class="container-fluid">
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
