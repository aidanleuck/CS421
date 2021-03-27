<?php
include 'database.php';
include 'cartList.php';
session_start();
$pID = $_GET['pID'];
echo $pID;

if(isset($_SESSION['cart'])){
    $_SESSION['cart']->removeCartItem($pID);
    
}