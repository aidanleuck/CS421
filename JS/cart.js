function removeCartRow(select) {
    $(select).closest("#cart-row").next("hr").remove();
    $(select).closest("#cart-row").remove();



    if ($("#cart-row").length == 0) {
        $("#container").html("<h1>Your cart is empty</h1>")
        $("#checkout").remove();
    }
}
function updateTotals(){
    var total = 0;
    $(".price").each(function(){
        total += parseFloat($(this).text().substring(1));
    });
    total = total.toFixed(2);
    $("#total").html("Subtotal: $" + total);
    $(".subtotal").html("<h2>$" + total +"</h2>");
    $(".sub").html("$" + total);
    
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
        updateTotals();


    });
    pID = []
    $($("#removeSel")).on('click', this, function (e) {
       e.preventDefault();
        $('.sel:checked').each(function () {
            pID.push($(this).val())
            removeCartRow($(this));
        });
      
      
        $.ajax({
            url: 'cart_handler.php',
            type: 'POST',
            cache: false,
            crossDomain: true,
            dataType: 'json',
            xhrFields: {
                withCredentials: true
            },
            data: {partID: pID, deleteSelected: '1'},
            success: function (message) {
                
            }
            

        });
        
        updateTotals();
     

    });

    $("#removeAll").on('click', this, function(e){
        e.preventDefault();
        $.ajax({
            url: 'cart_handler.php',
            type: 'POST',
            data: {deleteAll: '1'},
            success: function (message) {
                console.log(message);
            }
        });
        removeCartRow($('.row'));
    });








});

