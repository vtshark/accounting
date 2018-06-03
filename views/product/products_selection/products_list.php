<?
use kartik\checkbox\CheckboxX;
$selection_mode = Yii::$app->request->getQueryParam('selection_mode');
$invoice_id = Yii::$app->request->getQueryParam('invoice_id');
?>

    <input id="selection-mode" type="hidden" value="<?= $selection_mode ?>">
    <input id="invoice-id" type="hidden" hidden value="<?= $invoice_id ?>">

<table id="table-products-selection" class="cell-border table-hover" style="width:100%;">
    <thead>
    <tr>
        <? if (isset($attributeLabels['info']['#'])) { ?>
            <th>#</th>
        <? } ?>
        <? if (isset($attributeLabels['info']['check'])) { ?>
            <th></th>
        <? } ?>

        <? foreach ($attributeLabels['data'] as $label) { ?>
            <th><?=$label?></th>
        <? } ?>
    </tr>
    </thead>
    <tbody>
    <?
    if (!empty($products)) {
        $i = count($products) - 1;
        while ($i >= 0) { ?>
            <tr>
                <? if (isset($attributeLabels['info']['#'])) { ?>
                    <th></th>
                <? } ?>

                <? if (isset($attributeLabels['info']['check'])) {
                    $check = isset($products[$i]['check']) ? 1 : 0;
                    ?>
                    <th>
                        <div class="btn-checkbox">
                        <?= CheckboxX::widget([
                            'name' => 'ch_' . $products[$i]['id'],
                            'options' => [ 'id' => $products[$i]['id'] ],
                            'pluginOptions' => ['threeState' => false],
                            'value' => $check
                        ]); ?>
                        </div>
                    </th>
                <? } ?>

                <? foreach ($attributeLabels['data'] as $attribute => $label) { ?>
                    <td><?= $products[$i][$attribute] ?? '' ?></td>
                <? } ?>

            </tr>
        <?
        $i--;
        }
    }
    ?>
    </tbody>
</table>

    <button id="select-all-btn" class="btn btn-primary">
    <span class="glyphicon glyphicon-check lg" aria-hidden="true"></span>
</button>
    <button id="cancel-all-btn" class="btn btn-primary">
    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
</button>
<span class="pull-right">
<a href="<?=\yii\helpers\Url::to(['invoice-transfer/' . $invoice_id])?>"
   class="btn btn-primary">
    <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
    Вернуться к накладной
</a>

<a href="<?=\yii\helpers\Url::to(['product/confirm-selection/' . $selection_mode . '-' . $invoice_id])?>"
   class="btn btn-success">
    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
    Завершить отбор
</a>
</span>
<?
$script = <<<JS
    $(document).ready(function() {
        var t = $('#table-products-selection').DataTable({
            scrollY:        '65vh',
            scrollCollapse: true,
            paging:         false,
            "order": [[ 1, 'asc' ]],
            "language": {
                "info": "Показаны записи <b>_START_-_END_</b> из <b>_TOTAL_</b>"
            }
        });
        
        t.on( 'order.dt search.dt', function () {
            t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();
        
    } );
JS;
$this->registerCssFile("https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css", [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()]
]);
$this->registerJsFile(
    'https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJs($script, \yii\web\View::POS_READY);
?>