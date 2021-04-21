inputErrors = {};
additionalErrors = [];
function validateEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
function validateZip(zip) {
    var regex = /^(\d{5}(?:\-\d{4})?)$/;
    return regex.test(zip);
}

function validatePassword(password) {
    var regex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}/;
    return regex.test(password);
}

function modifyInput() {
    for (var key in inputErrors) {
        $(key).addClass("errorInput");
        $(key).fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
    }
    inputErrors = {};

}
function printAdditionalErrors() {
    $("#additionalErrors").html("");

    $("#additionalErrors").append("<h3>Additional Errors</h3>");
    for (i = 0; i < additionalErrors.length; i++) {
        $("#additionalErrors").append(
            "<div id = 'error_box'>" +
            "<span class='error_symbol'><i class='fas fa-exclamation-triangle'></i></span>" +
            "<span class = 'middle'>" + additionalErrors[i] + "</span>" +
            "<span class = 'right'><i class='fas fa-times-circle'></i></span>" +
            "</div>"
        )
    }
    additionalErrors = [];
}

function resetInput() {
    $("#inputError input").each(function () {
        $(this).removeClass("errorInput");
        $(this).next('.error').html("");
    });
    $("#state").removeClass("errorInput");
    $("#state").next('.error').html("");
}

function addErrorMessage(selector, message) {
    $(selector).html(message);
}

function isEqual(x, y) {
    if (x != y) {
        return false;
    }
    return true;
}
function checkEmpty(x) {
    if (x == "") {
        return true;
    }
    return false;
}

function checkState(state) {
    states = ["AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "FL", "GA", "HI", "ID", "IL", "IN", "IA", "KS", "KY",
        "LA", "ME", "MD", "MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ", "NM", "NY", "NC", "ND", "OH", "OK", "OR", "PA",
        "RI", "SC", "SD", "TN", "TX", "UT", "VT", "VA", "WA", "WV", "WI", "WY"];
    for (i = 0; i < states.length; i++) {
        if (state == states[i]) {
            return true;
        }
    }
    return false;
}

$(document).ready(function () {

    $("#form").submit(function (e) {


        resetInput();
        var email1 = $("#email").val();
        var address = $("#address").val();
        var city = $("#city").val();
        var state = $("#state").find(':selected').text();
        var zipcode = $("#zip").val();

        if (checkEmpty(email1)) {
            addErrorMessage($("#email").next('.error'), "*");
            inputErrors["#email"] = true;
        }
        else if (!validateEmail(email1)) {
            addErrorMessage($("#email").next('.error'), "Email is invalid");
            inputErrors["#email"] = true;
        }

        if (checkEmpty(address)) {
            addErrorMessage($("#address").next('.error'), "*");
            inputErrors["#address"] = true;
        }

        if (checkEmpty(city)) {
            addErrorMessage($("#city").next('.error'), "*");
            inputErrors["#city"] = true;
        }

        if (checkEmpty(zipcode)) {
            addErrorMessage($("#zip").next('.error'), "*");
            inputErrors["#zip"] = true;
        }
        if (!checkState(state)) {
            addErrorMessage($("#state").next('.error'), "Invalid state");
            inputErrors["#state"] = true;
        }
        else if (!validateZip(zipcode)) {
            addErrorMessage($("#zip").next('.error'), "Invalid zip code");
            inputErrors["#zip"] = true;
        }


        if (Object.keys(inputErrors).length > 0 || additionalErrors.length > 0) {
            e.preventDefault();
            modifyInput();
        }


    });


});