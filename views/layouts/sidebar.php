<?
use yii\helpers\Url;
use kartik\sidenav\SideNav;
?>

<ul class="nav nav-tabs">
    <li role="presentation" class="sidebar-li">
        <a id="sidebar-btn" href="#"><?= Yii::$app->user->identity->username . " | " . date("d.m.Y") ?> <i class="fas fa-lg fa-cogs"></i></a>

        <div class="sidebar-wrapper">
        <?
        $controller_id = Yii::$app->controller->id;
        $username = Yii::$app->user->identity->username;
        //echo "<pre>" . print_r($user ,1) . "</pre>"; die;
        echo SideNav::widget([
            'type' => "default",
            'class' => "sidebar",
            'encodeLabels' => false,
    //        'heading' => '<div class="menu">' . $username . '<span class="glyphicon glyphicon-cog pull-right" aria-hidden="true"></span></div>',
    //        'heading' => '&nbsp<span class="pull-right">' . $username . '&nbsp<i class="fas fa-bars menu"></i></span>',
            'items' => [
    //            ['label' => '<i class="fas fa-arrows-alt-h test"></i>'],
                ['label' => '<i class="fas fa-gem"></i><span> Закупки</span>', 'url' => Url::to(['/invoice-procurement']), 'active' => ($controller_id == 'invoice-procurement')],
                ['label' => '<i class="fas fa-retweet"></i><span> Выдачи</span>', 'url' => Url::to(['/invoice-transfer']), 'active' => ($controller_id == 'invoice-transfer')],
                ['label' => '<i class="fas fa-dollar-sign"></i><span> Продажи</span>', 'url' => Url::to(['/site/online-1'])],
                ['label' => '<i class="fas fa-database"></i><span> Изделия</span>', 'url' => Url::to(['/products']), 'active' => ($controller_id == 'products')],

                ['label' => '<i class="fas fa-book"></i><span> Справочники</span>', 'items' => [
                    ['label' => '<i class="fas fa-gem"></i><span> Закупки</span>', 'url' => Url::to(['/invoice-procurement'])],
                    ['label' => '<i class="fas fa-gem"></i><span> Закупки</span>', 'url' => Url::to(['/invoice-procurement'])],
                    ]
                ],
                ['label' => '<i class="fas fa-sign-out-alt"></i><span> Выход</span>', 'url' => Url::to(['/login/logout'])],
            ],
        ]);

        ?>
        </div>
    </li>
</ul>