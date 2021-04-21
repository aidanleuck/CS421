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


    for (i = 0; i < additionalErrors.length; i++) {
        $(".button").before("<div id = 'additionalErrors'><h3>Additional Errors</h3>");
        $("#additionalErrors").append(
            "<div id = 'error_box'>" +
            "<span class='error_symbol'><i class='fas fa-exclamation-triangle'></i></span>" +
            "<span class = 'middle'>" + additionalErrors[i] + "</span>" +
            "<span class = 'right'><i class='fas fa-times-circle'></i></span>" +
            "</div>" +
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

    if ($("#currentPassword").next('.error').text() == "Incorrect Password") {
        $("#currentPassword").addClass('errorInput');
    }

    $("#submit").submit(function (e) {


        resetInput();
        var currentPassword = $("#currentPassword").val();
        var newPassword1 = $("#newPassword1").val();
        var newPassword2 = $("#newPassword2").val();

        if (checkEmpty(currentPassword)) {
            addErrorMessage($("#currentPassword").next('.error'), "*");
            inputErrors["#currentPassword"] = true;
        }

        if (checkEmpty(newPassword1)) {
            addErrorMessage($("#newPassword1").next('.error'), "*");
            inputErrors["#newPassword1"] = true;
        }
        else if (!validatePassword(newPassword1)) {
            addErrorMessage($("#newPassword1").next('.error'), "Password must contain 8 characters and include 1 special character and number");
            inputErrors["#newPassword1"] = true;
        }

        if (checkEmpty(newPassword2)) {
            addErrorMessage($("#newPassword2").next('.error'), "*");
            inputErrors["#newPassword2"] = true;
        }
        else if (!validatePassword(newPassword2)) {
            addErrorMessage($("#newPassword2").next('.error'), "Password must contain 8 characters and include 1 special character and number");
            inputErrors["#newPassword2"] = true;
        }
        if (!isEqual(newPassword1, newPassword2)) {
            additionalErrors.push("Passwords do not match");
        }




        if (Object.keys(inputErrors).length > 0 || additionalErrors.length > 0) {
            e.preventDefault();
            modifyInput();
            printAdditionalErrors();
        }


    });


});