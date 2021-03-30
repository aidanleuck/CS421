<?php
include 'database.php';
include 'cartList.php';
include 'user.php';
session_start();
$dao = new Database();
print_r($_POST);
if(isset($_POST['deleteAll'])){
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
        $dao->deleteCart($_SESSION['user']->getAccountID());
        header('Location: cart.php');
    }
    else{
        if(isset($_SESSION['cart'])){
            $_SESSION['cart']->emptyCart();
        }
        header('Location: cart.php');
    }
}
else if(isset($_POST['checkout'])){
    header('Location:checkout.php');
    exit;
}
else if(isset($_POST['deleteSelected'])){
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
        foreach($_POST['partID'] as $delItem){
            $dao->deletePartialCart($_SESSION['user']->getAccountID(), $delItem);
        }
        header('Location: cart.php');
        
    }

    else{
        if(isset($_SESSION['cart'])){
            foreach($_POST['partID'] as $delItem){
                $_SESSION['cart']->removeCartItem($delItem);
            }
            header('Location: cart.php');
            
        }
    }
}