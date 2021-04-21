function removeCartRow(select) {
    $(select).closest("#cart-row").next("hr").remove();
    $(select).closest("#cart-row").remove();



    if ($("#cart-row").length == 0) {
        $("#container").html("<h1>Your cart is empty</h1>")
        $("#checkout").remove();
    }
}

$(document).ready(function () {
    $(".deleteL").on('click', this, function (e) {
        e.preventDefault();
        $(this).css("color", "orange");


        $.ajax({
            url: "delete_handler.php",
            type: 'GET',
            data: {
                pID: $(this).attr('data')
            },
            success: function (data) {

            }
        })
        removeCartRow(this);


    });
    pID = []
    $("#removeSel").on('click', this, function (e) {
        e.preventDefault();
        $('.sel:checked').each(function () {
            pID.push($(this).val())
        });

        $.ajax({
            url: 'cart_handler.php',
            type: 'POST',
            data: { partID: pID, deleteSelected: '1' },

            success: function (message) {

            }

        });

    });








});

