<?php
include 'user.php';
include 'database.php';
session_start();
if(!$_SESSION['logged_in']){
    header('Location: index.php');
    exit;
}


$_SESSION['errors'] = array();
$_SESSION['succesfulForm'] = FALSE;

function checkPassword($password){
    $result = preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}/", $password);
 
    if($result){
        return True;
    }
    return False;
 }
 $dao = new Database();

 $result = $dao->getUserPasswordByID($_SESSION['user']->getAccountID());
 
 
if($_POST['currentPassword'] === ""){
    $_SESSION['errors']['currentPassword'] = "*";
}
else if(!password_verify($_POST['currentPassword'], $result["password"])){
    $_SESSION['errors']['currentPassword'] = "Incorrect Password";
}

if($_POST['newPassword1'] === ""){
    $_SESSION['errors']['newPassword1'] = "*";
}
else if(!checkPassword($_POST['newPassword1'])){
    $_SESSION['errors']['newPassword1'] = "Password must contain 8 characters and one number and special character.";
}

if($_POST['newPassword2'] === ""){
    $_SESSION['errors']['newPassword2'] = "*";
}
else if(!checkPassword($_POST['newPassword2'])){
    $_SESSION['errors']['newPassword2'] = "Password must contain 8 characters and one number and special character.";
}

if($_POST['newPassword1'] !== $_POST['newPassword2']){
    $_SESSION['additionalErrors'] = "Passwords do not match";
}


if(count($_SESSION['errors']) || isset($_SESSION['additionalErrors']) ){
    $_SESSION['succesfulForm'] = FALSE;
    
}
else{
    $_SESSION['succesfulForm'] = TRUE;

    $dao->updatePassword($_SESSION['user']->getAccountID(), password_hash($_POST['newPassword1'], PASSWORD_DEFAULT));

}
header('Location:updatePassword.php');