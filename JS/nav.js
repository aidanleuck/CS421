$(document).ready(function(){
    var url = window.location.href;
    
    $('.nav-item a').each(function(){
        var linkpage = this.href;
        

        if(url == linkpage){
            $(this).closest("li").attr("id", "active");
            $(this).attr("id", "color");
            
        }
    });
    $('.user-info a').each(function(){
        var linkpage = this.href;
        if(url == linkpage){
            $(this).closest("li").attr("id","active");
            $(this).attr("id", "color");
        }
    });
});