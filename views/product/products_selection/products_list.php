<?
$selection_mode = Yii::$app->request->getQueryParam('selection_mode');
$invoice_id = Yii::$app->request->getQueryParam('invoice_id');
?>
<table id="table-products-selection" class="cell-border table-hover" style="width:100%">
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
        foreach ($products as $product) { ?>
            <tr>
                <? if (isset($attributeLabels['info']['#'])) { ?>
                    <th></th>
                <? } ?>

                <? if (isset($attributeLabels['info']['check'])) {
                    $check = (isset($product['check'])) ? 'active' : '';
                    ?>
                    <th>
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default btn-checkbox <?=$check?>"
                                   data-id="<?=$product['id']?>"
                                   data-selection_mode="<?=$selection_mode?>"
                                   data-invoice_id="<?=$invoice_id?>"
                            >
                            <input type="checkbox" autocomplete="off">
                            <span class="glyphicon glyphicon-ok"></span>
                        </label>
                        </div>
                    </th>
                <? } ?>

                <? foreach ($attributeLabels['data'] as $attribute => $label) { ?>
                    <td><?= $product[$attribute] ?? '' ?></td>
                <? } ?>

            </tr>
        <? }
    }
    ?>
    </tbody>
</table>

<button class="btn btn-primary">
    <span class="glyphicon glyphicon-check lg" aria-hidden="true"></span>
</button>
<button class="btn btn-primary">
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