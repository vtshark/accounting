"use strict";
$(document).ready(function () {
    $("#table-products-selection .btn-checkbox").click(function(e) {
        var obj = $(this),
            checked = !obj.hasClass("active"),
            id = obj.data("id"),
            selection_mode = obj.data("selection_mode"),
            invoice_id = obj.data("invoice_id");


        $.ajax({
            url: "/product/select",
            data: {id: id, checked: checked, selection_mode: selection_mode, invoice_id: invoice_id},
            type: 'POST',
            dataType: 'json',
            success: function (json) {
                if (json.error) {
                    (!checked) ? obj.addClass("active") : obj.removeClass("active");
                } else {

                }
            },
            error: function (json) {
                console.log('Error!');
                //$(this).addClass(activeClass);
                (!checked) ? obj.addClass("active") : obj.removeClass("active");
            }
        });
    });

});