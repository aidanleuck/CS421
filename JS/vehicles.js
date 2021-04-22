var vehicles = {
    vehicle : {}
}
function InitInfo(selectedMake, selectedModel){
   var modelArray = [];
   var yearArray = [];
   vehicles.vehicle = {[selectedMake] : {model: [], year: []}};
   
   $.ajax({
    url: 'manageVehicle_handler.php',
    type: 'POST',
    cache: false,
    crossDomain: true,
    xhrFields: {
        withCredentials: true
    },
    data: {selectedMake: selectedMake, selectedModel: selectedModel},
    success: function (message) {
        var data = JSON.parse(message);
        Object.keys(data).forEach(function(key, value){
            $("#model").append('<option>' + data[key]["model"] + '</option>');
        });
         
                selectedModel = data[0]["model"];
            
            
            
            
        
        $.ajax({
            url: 'manageVehicle_handler.php',
            type: 'POST',
            cache: false,
            crossDomain: true,
            xhrFields: {
                withCredentials: true
            },
            data: {selectedMake: selectedMake , selectedModel: selectedModel},
            success: function (message2) {
                
            
                var data2 = JSON.parse(message2);
                
                Object.keys(data2).forEach(function(key2, value2){
                    $("#year").append('<option>' + data2[key2]["year"] + '</option>');
                });
            },
        });
    },
});
}
function UpdateInfo(selectedMake, selectedModel){
    var modelArray = [];
    var yearArray = [];
    vehicles.vehicle = {[selectedMake] : {model: [], year: []}};
    
    $.ajax({
     url: 'manageVehicle_handler.php',
     type: 'POST',
     cache: false,
     crossDomain: true,
     xhrFields: {
         withCredentials: true
     },
     data: {selectedMake: selectedMake, selectedModel: selectedModel},
     success: function (message) {
         var data = JSON.parse(message);
         
         
         $.ajax({
             url: 'manageVehicle_handler.php',
             type: 'POST',
             cache: false,
             crossDomain: true,
             xhrFields: {
                 withCredentials: true
             },
             data: {selectedMake: selectedMake , selectedModel: selectedModel},
             success: function (message2) {
                 
                 console.log(selectedModel);
                 var data2 = JSON.parse(message2);
                 Object.keys(data2).forEach(function(key2, value2){
                     $("#year").append('<option>' + data2[key2]["year"] + '</option>');
                 });
             },
         });
     },
 });
 


}

$(document).ready(function(){
    var selectedMake = $("#make").val();
    var selectedModel = ""
    InitInfo(selectedMake, selectedModel);
    
    $("#make").on('change', function(){
        $("#model").html("");
        $("#year").html("");
        var selectedMake = $("#make").val();
        var selectedModel = ""

       
        InitInfo(selectedMake, selectedModel);
    });
    $("#model").on('change', function(){
       
        var selectedMake = $("#make").val();
        var selectedModel = $("#model").val();
        
        $("#year").html("");
        

       
        UpdateInfo(selectedMake, selectedModel);
    });

    $('.delete').on('click', this, function(e){
        e.preventDefault();
        
        $.ajax({
            url: 'removeVehicleHandler.php',
            type: 'GET',
            cache: false,
            crossDomain: true,
            xhrFields: {
                withCredentials: true
            },
            data: {vID: $(this).next('.vID').val()},
            success: function (message2) {

            },

    });
    $(this).closest(".data").remove();
});


    

    
    
});