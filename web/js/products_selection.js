"use strict";
$(document).ready(function () {
    $("#table-products-selection .btn-checkbox").click(function(e) {
        var obj = $(this),
            checked = !obj.hasClass("active"),
            id = obj.data("id"),
            selection_mode = $("#selection-mode").val(),
            invoice_id = $("#invoice-id").val();


        $.ajax({
            url: "/product/select",
            data: {id: id, checked: checked, selection_mode: selection_mode, invoice_id: invoice_id},
            type: 'POST',
            dataType: 'json',
            success: function (json) {
                if (json.error) {
                    obj.toggleClass("active");
                } else {

                }
            },
            error: function (json) {
                console.log('Error!');
                obj.toggleClass("active");
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
            var checkBox = $(cell_checkbox).find("label.btn-checkbox");
            if (!checkBox.hasClass("active")) {
                var cell = $(this).children()[2];
                ids.push(cell.innerText);
            }
        });

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
                        var checkBox = $(cell_checkbox).find("label.btn-checkbox");
                        if (!checkBox.hasClass("active")) {
                            checkBox.addClass("active");
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
            invoice_id = $("#invoice-id").val();

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
                        var checkBox = $(cell_checkbox).find("label.btn-checkbox");
                        if (checkBox.hasClass("active")) {
                            checkBox.removeClass("active");
                        }
                    });
                }
            },
            error: function (json) {
                console.log('Error!');
            }
        });
    });

});