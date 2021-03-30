<?php 
include 'database.php';
include 'user.php';
session_start();

if(!$_SESSION['logged_in']){
    header('Location: index.php');
    exit;
}
$_SESSION['errors'] = array();
$_SESSION['savedForm'] = array();
$_SESSION['succesfulForm'] = FALSE;

function checkZip($zip){
    $result = preg_match("/^(\d{5}(?:\-\d{4})?)$/", $zip);
 
    if($result){
        return True;
    }
    return False;
 }

if($_POST['email'] === ""){
    $_SESSION['errors']['email'] = "*";
}
else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $_SESSION['errors']['email'] = "Invalid Email Address";
}
else{
    $_SESSION['savedForm']['email'] = $_POST['email'];
}
if($_POST['address'] === ""){
    $_SESSION['errors']['address'] = "*";
}
else{
    $_SESSION['savedForm']['address'] = $_POST['address'];
}
if($_POST['city'] === ""){
    $_SESSION['errors']['city'] = "*";
}
else{
    $_SESSION['savedForm']['city'] = $_POST['city'];
}
$states = array("AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "FL", "GA", "HI", "ID", "IL", "IN", "IA", "KS", "KY", 
                    "LA", "ME", "MD", "MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ", "NM", "NY", "NC", "ND", "OH", "OK", "OR", "PA",
                    "RI", "SC", "SD", "TN", "TX", "UT", "VT", "VA", "WA", "WV", "WI", "WY");

if(!isset($_POST['state']) || array_search($_POST["state"], $states) === FALSE){
    $_SESSION['errors']['state'] = "You did not enter a valid state";
}
else{
    
    $_SESSION['savedForm']['state'] = $_POST['state'];
    
}
if($_POST["zip"] === ""){
    $_SESSION['errors']['zip'] = "*";
}
else if (!checkZip($_POST["zip"])){
    $_SESSION['errors']['zip'] = "Invalid Zip Code";

}
if(count($_SESSION['errors'])){
    $_SESSION['succesfulForm'] = FALSE;
}
else{
    $_SESSION['succesfulForm'] = TRUE;
    
    $dao = new Database();
    $dao->updateUser($_SESSION['user']->getAccountID(), $_POST['email'], $_POST['address'], $_POST['city'], $_POST['state'], $_POST['zip']);

}

header('Location: manageUserInfo.php');