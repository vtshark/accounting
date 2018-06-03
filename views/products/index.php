<?
$this->title = 'Изделия';
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="col-xs-12">
        <?= $this->render('search_form', ['searchModel' => $searchModel]); ?>
    </div>
    <div class="col-xs-12">
        <?= $this->render('list',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider
            ]
        );
        ?>
    </div>
