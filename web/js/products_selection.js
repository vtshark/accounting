"use strict";
$(document).ready(function () {
    $("#table-products-selection .btn-checkbox").click(function(e) {
        var obj = $(this);
        var checked = !obj.hasClass("active");
        var id = obj.data("id");


        $.ajax({
            url: "/product/select",
            data: {id: id, checked: checked},
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