<?php

session_start();
include 'database.php';
include 'user.php';

$_SESSION['errors'] = array();
$_SESSION['additionalErrors'] = array();
$_SESSION['savedForm'] = array();


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
 }
 if($_POST['confirmEmail'] === ""){
    $_SESSION['errors']['emptyEmail2'] = TRUE;

 }
 else{
    if(!(filter_var($_POST['confirmEmail'], FILTER_VALIDATE_EMAIL))){
        $_SESSION['errors']['email2Valid'] = FALSE;
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
}
if($_POST['confirmPassword'] === ""){
   $_SESSION['errors']['emptyPassword2'] = TRUE;
}
else{
    if(!(checkPassword($_POST['confirmPassword']))){
        $_SESSION['errors']['password2Valid'] = FALSE;
    }
}

if($_POST['password'] !== $_POST['confirmPassword']){
    $_SESSION['additionalErrors']['passwordsMatch'] = "Passwords do not match";
}



if(count($_SESSION['additionalErrors']) || count($_SESSION['errors'])){
    $_SESSION['savedForm']['email1'] = $_POST['email'];
    $_SESSION['savedForm']['email2'] = $_POST['confirmEmail'];
    header('Location:create_account.php');
    exit;
}
else{
    $dao = new Database();
    if(!$dao->getUserByEmail($_POST['email'])){
        $dao->addUser($_POST['email'], $_POST['password']);
        $result = $dao->getUserID($_POST['email'], $_POST['password']);
        $_SESSION['user'] = new User($result['accountID'], $_POST['email']);
        $_SESSION['logged_in'] = TRUE;
        $_SESSION['errors'] = NULL;
        $_SESSION['additionalErrors'] = NULL;
        $_SESSION['savedForm'] = NULL;
        header('Location: account.php');
    }
    else{
        $_SESSION['additionalErrors']['userExists'] = "A user already exists for that email address";
        header('Location:create_account.php');
        exit;
    }
    
    
    
}


    
?>