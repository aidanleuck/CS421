<?php
include 'database.php';
include 'cartList.php';
include 'user.php';
session_start();
$pID = urldecode($_GET['pID']);

if(isset($pID)){
    if(!$_SESSION['logged_in']){
        if(isset($_SESSION['cart'])){
            $_SESSION['cart']->removeCartItem($pID);
            
        }
    }
    else{
        $dao = new Database();
        $dao->deletePartialCart($_SESSION['user']->getAccountID(),$pID);
    }
    
}
Header('Location: cart.php');
