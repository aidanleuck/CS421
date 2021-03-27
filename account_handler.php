<?php

session_start();
include 'database.php';
include 'user.php';

$_SESSION['errors'] = array();
$_SESSION['additionalErrors'] = array();

function checkPassword($password){
    $result = preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}/", $password);
 
    if($result){
        return True;
    }
    return False;
 }
 if($_POST['email'] === ""){
     $_SESSION['errors']['emptyEmail1'] = TRUE;
   
 }
 else{
    if(!(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))){
        $_SESSION['errors']['email1Valid'] = False;
    }
    else{
        $_SESSION['errors']['email1Valid'] = True;
    } 
 }
 if($_POST['confirmEmail'] === ""){
    $_SESSION['errors']['emptyEmail2'] = TRUE;

 }
 else{
    if(!(filter_var($_POST['confirmEmail'], FILTER_VALIDATE_EMAIL))){
        $_SESSION['errors']['email2Valid'] = FALSE;
    }
    else{
        $_SESSION['errors']['email2Valid'] = TRUE;
    }
 }

 if($_POST['email'] !== $_POST['confirmEmail']){
    $_SESSION['additionalErrors']['emailsMatch'] = "Emails do not match";
 }

 
if($_POST['password'] === ""){
    $_SESSION['errors']['emptyPassword1'] = TRUE;

    
}
else{
    if(!(checkPassword($_POST['password']))){
        $_SESSION['errors']['password1Valid'] = FALSE;
    }
    else{
        $_SESSION['errors']['password1Valid'] = TRUE;
    }
}
if($_POST['confirmPassword'] === ""){
   $_SESSION['errors']['emptyPassword2'] = TRUE;
}
else{
    if(!(checkPassword($_POST['confirmPassword']))){
        $_SESSION['errors']['password2Valid'] = FALSE;
    }
    else{

    }
}

if($_POST['password'] !== $_POST['confirmPassword']){
    $_SESSION['additionalErrors']['passwordsMatch'] = "Passwords do not match";
}




if(count($_SESSION['errors']) || count($_SESSION['additionalErrors'])){
    header('Location:create_account.php');
}
else{
    
}


    
?>