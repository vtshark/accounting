"use strict";
$(document).ready(function () {
    $("#table-products-selection .btn-checkbox").click(function(e) {
        var obj = $(this),
            checkbox = $(this).find("input"),
            checked = checkbox.val(),
            id = checkbox.attr('id'),
            selection_mode = $("#selection-mode").val(),
            invoice_id = $("#invoice-id").val();

            $.ajax({
                url: "/product/select",
                data: {id: id, checked: checked, selection_mode: selection_mode, invoice_id: invoice_id},
                type: 'POST',
                dataType: 'json',
                success: function (json) {
                    if (json.error) {
                        checkbox.val(!checked);
                        obj.find('.glyphicon-ok').remove();
                    } else {

                    }
                },
                error: function (json) {
                    console.log('Error!');
                    checkbox.val(!checked);
                    obj.find('.glyphicon-ok').remove();
                }
            });
    });

    $("#select-all-btn").click(function (e) {
        var table = $("#table-products-selection tbody"),
            rows = table.find("tr"),
            ids = [],
            selection_mode = $("#selection-mode").val(),
            invoice_id = $("#invoice-id").val();

        rows.each(function () {
            var cell_checkbox = $(this).children()[1];
            var checkBox = $(cell_checkbox).find("input");
            if (parseInt(checkBox.val()) === 0) {
                var cell = $(this).children()[2];
                ids.push(cell.innerText);
            }
        });

        if (ids.length === 0) {
            return false;
        }

        $.ajax({
            url: "/product/multi-select",
            data: {ids: ids, selection_mode: selection_mode, invoice_id: invoice_id},
            type: 'POST',
            dataType: 'json',
            success: function (json) {
                if (json.error) {

                } else {
                    rows.each(function () {
                        var cell_checkbox = $(this).children()[1];
                        var checkBox = $(cell_checkbox).find("input");
                        if (parseInt(checkBox.val()) === 0) {
                            $(cell_checkbox).find(".cbx-icon").append('<i class="glyphicon glyphicon-ok"></i>');
                            checkBox.val(1);
                        }
                    });
                }
            },
            error: function (json) {
                console.log('Error!');
            }
        });
    });

    $("#cancel-all-btn").click(function (e) {
        var table = $("#table-products-selection tbody"),
            rows = table.find("tr"),
            selection_mode = $("#selection-mode").val(),
            invoice_id = $("#invoice-id").val(),
            ids = [];

        rows.each(function () {
            var cell_checkbox = $(this).children()[1];
            var checkBox = $(cell_checkbox).find("input");
            if (parseInt(checkBox.val()) === 1) {
                var cell = $(this).children()[2];
                ids.push(cell.innerText);
            }
        });
        if (ids.length === 0) {
            return false;
        }

        $.ajax({
            url: "/product/clear-select",
            data: {selection_mode: selection_mode, invoice_id: invoice_id},
            type: 'POST',
            dataType: 'json',
            success: function (json) {
                if (json.error) {

                } else {
                    rows.each(function () {
                        var cell_checkbox = $(this).children()[1];
                        var checkBox = $(cell_checkbox).find("input");
                        if (parseInt(checkBox.val()) === 1) {
                            $(cell_checkbox).find('.glyphicon-ok').remove();
                            checkBox.val(0);
                        }
                    });
                }
            },
            error: function (json) {
                console.log('Error!');
            }
        });
    });


    if ($("#searchform-auto_check").attr('checked')) {
        $( "#searchform-id" ).select().focus();
    }

});