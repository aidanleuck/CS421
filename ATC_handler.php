<?php 
include 'database.php';
include 'user.php';
include 'CartItem.php';
include 'cartList.php';
session_start();

$dao = new Database();
    if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] === FALSE ){
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = new CartList();
        }
        
            if(isset($_POST['id'])){
                $currentList = $_SESSION['cart'];
                $result = $dao->getPartInfo($_POST['id']);
                $cart= new CartItem($result['partID'], $result['imageSrc'],
                $result['partName'], $result['partDesc'], $result['stock'], $result['price']);
                $currentList->addCartItem($cart);
                $_SESSION['cart'] = $currentList;
            }
             header('Location: cart.php');

        }
        else{
            if(isset($_POST['id'])){
                $dao->addToCart($_SESSION['user']->getAccountID(), $_POST['id']);
            }
        header('Location:cart.php');
    }