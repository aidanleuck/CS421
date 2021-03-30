<?php
include 'database.php'; 
include 'checkoutClass.php';
include 'user.php';
session_start();

if(!isset($_SESSION['checkoutInfo']) || !$_SESSION['logged_in']){
    header('Location:index.php');
}
else{
$dao = new Database();

$keys = $_SESSION['checkoutInfo']->getParts(); 
  

foreach($keys as $key){
    if(!$dao->inCart( $key, $_SESSION['user']->getAccountID())) {
        header('Location:cart.php');
        exit;
    }
}
}

$dao = new Database();

$oID = uniqid();

$dao->addOrder($oID, $_SESSION['checkoutInfo']->getTotal(), $_SESSION['user']->getAccountID());

$keys = $_SESSION['checkoutInfo']->getParts(); 
  
$array = $_SESSION['checkoutInfo']->getArray();
foreach($keys as $key){
    
    $dao->addOrderManifest($oID, $key, $array[$key]);
    $dao->updateStock($key, $array[$key]);
}
$_SESSION['checkoutInfo'] = NULL;
$dao->deleteCart($_SESSION['user']->getAccountID());

 header('Location: index.php');


?>