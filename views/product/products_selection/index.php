<div class="container-fluid">

    <div class="col-xs-12 col-sm-3 col-lg-2">
        <?= $this->render('search_form', ['searchForm' => $searchForm]); ?>
    </div>
    <div class="col-xs-12 col-sm-9 col-lg-10">
        <?= $this->render('products_list', ['productsList' => $productsList]); ?>
    </div>
</div>

