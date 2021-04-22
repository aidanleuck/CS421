$(document).ready(function(){
    var url = window.location.href;
    
    $('.nav-item a').each(function(){
        var linkpage = this.href;
        

        if(url == linkpage){
            $(this).closest("li").attr("id", "active");
            $(this).attr("id", "color");
            
        }
    });
    $('.user-info .link').each(function(){
        var linkpage = this.href;
        if(url == linkpage){
            $(this).parent("li").attr("id","active");
            $(this).attr("id", "color");
        }
    });
    $('.fa-car').click(function(){
        if($('.dropDown').hasClass("hidden")){
            $('.dropDown').slideDown(1000);
            
        }
        else{
            $('.dropDown').slideUp(1000);
        }
        
        $('.dropDown').toggleClass("hidden", function(){
            
        });
      
            
    
    });

    $('.vehicleSel').on('change', this, function(){
        $.ajax({
            url: 'updateSelCar.php',
            type: 'POST',
            cache: false,
            crossDomain: true,
            xhrFields: {
                withCredentials: true
            },
            data: {text: $(this).val()},
            success: function (message) {
                
            },
        });
    });
});