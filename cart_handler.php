<?php
include 'database.php';
include 'cartList.php';
include 'user.php';
include 'checkoutClass.php';
session_start();
print_r($_POST);
$dao = new Database();
if(isset($_POST['deleteAll'])){
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
      
        $dao->deleteCart($_SESSION['user']->getAccountID());
        echo $_SESSION['user']->getAccountID();
        echo 'hello';
        //header('Location: cart.php');
    }
    else{
        if(isset($_SESSION['cart'])){
            $_SESSION['cart']->emptyCart();
        }
       //header('Location: cart.php');
       exit();
    }
}
else if(isset($_POST['checkout'])){

    $_SESSION['checkoutInfo'] = new checkOutData($_POST['partIDCheckout'], $_POST['quantity']);
    header('Location: checkout.php');
    exit();
}
else if(isset($_POST['deleteSelected'])){
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
        
        foreach($_POST['partID'] as $delItem){
            
            $dao->deletePartialCart($_SESSION['user']->getAccountID(), $delItem);
        }
        
       //header('Location: cart.php');
       exit();
    }

    else{
        if(isset($_SESSION['cart'])){
            foreach($_POST['partID'] as $delItem){
            
                $_SESSION['cart']->removeCartItem($delItem);
        
            }
           //header('Location: cart.php');
           exit();
            
        }
    }
}