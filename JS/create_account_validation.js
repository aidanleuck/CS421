inputErrors = {};
additionalErrors = [];
function validateEmail(email){
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function validatePassword(password){
    var regex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}/;
    return regex.test(password);
}

function modifyInput(){
    for(var key in inputErrors){
        $(key).addClass("errorInput");
        $(key).fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
    }
    inputErrors = {};

}
function printAdditionalErrors(){
    $("#additionalErrors").html("");
    
    $("#additionalErrors").append("<h3>Additional Errors</h3>");
    for(i =0; i < additionalErrors.length; i++){
       $("#additionalErrors").append(
           "<div id = 'error_box'>" + 
                 "<span class='error_symbol'><i class='fas fa-exclamation-triangle'></i></span>" +
                 "<span class = 'middle'>" +additionalErrors[i] +"</span>" +
                 "<span class = 'right'><i class='fas fa-times-circle'></i></span>" +
           "</div>"
        )
    }
    additionalErrors = [];
}

function resetInput(){
    $("#input input").each(function(){
        $(this).removeClass("errorInput");
        $(this).next('.error').html("");
    });
}

function addErrorMessage(selector, message){
    $(selector).html(message);
}

function isEqual(x, y){
    if(x != y){
        return false;
    }
    return true;
}
function checkEmpty(x){
    if(x== ""){
        return true;
    }
    return false;
}


$(document).ready(function(){

    $("#submit").submit(function(e){
        e.preventDefault();

        resetInput();
        var email1 = $("#email").val();
        var email2 = $("#confirmEmail").val();
        var password1 = $("#password").val();
        var password2 = $("#confirmPassword").val();
        
        if(checkEmpty(email1)){
            addErrorMessage($("#email").next('.error'), "*");
            inputErrors["#email"] = true;
        }
        else if(!validateEmail(email1)){
            addErrorMessage($("#email").next('.error'), "Email is invalid");
            inputErrors["#email"] = true;
        }

        if(checkEmpty(email2)){
            addErrorMessage($("#confirmEmail").next('.error'), "*");
            inputErrors["#confirmEmail"] = true;
        }
        else if(!validateEmail(email2)){
            addErrorMessage($("#confirmEmail").next('.error'), "Email is invalid");
            inputErrors["#confirmEmail"] = true;
        }

        if(!isEqual(email1,email2)){
            inputErrors["#confirmEmail"] = true;
            inputErrors["#email"] = true;

            additionalErrors.push("Emails do not match");
        }

        if(checkEmpty(password1)){
            addErrorMessage($("#password").next('.error'), "*");
            inputErrors["#password"] = true;
        }
        else if(!validatePassword(password1)){
            addErrorMessage($("#password").next('.error'), "Password must be 8 characters and contain 1 number and 1 special character");
            inputErrors["#password"] = true;
        }

        if(checkEmpty(password2)){
            addErrorMessage($("#confirmPassword").next('.error'), "*");
            inputErrors["#confirmPassword"] = true;
        }
        else if(!validatePassword(password2)){
            addErrorMessage($("#confirmPassword").next('.error'), "Password must be 8 characters and contain 1 number and 1 special character");
            inputErrors["#confirmPassword"] = true;
        }

        if(!isEqual(password1,password2)){
            inputErrors["#password"] = true;
            inputErrors["#confirmPassword"] = true;
            additionalErrors.push("Passwords do not match");
            
        }
        
        if(additionalErrors.length > 0){
            printAdditionalErrors();
        }

        modifyInput();
       

        
    });

    $("#additionalErrors").on('mouseenter', '.right', function(e){
       
        $(this).css("color", "white");
    });

    $("#additionalErrors").on('mouseleave', '.right', function(e){
       
        $(this).css("color", "black");
    });
   
       
    $("#additionalErrors").on('click', '#error_box', function(e){
       
        $(this).fadeOut(1000)
    });



    

});