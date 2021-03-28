<?php
include 'database.php';
include 'cartList.php';
session_start();
$pID = urldecode($_GET['pID']);
if(isset($pID)){
    if(isset($_SESSION['cart'])){
        $_SESSION['cart']->removeCartItem($pID);
        
    }
}
Header('Location: cart.php');
