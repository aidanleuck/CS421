<?php
session_start();

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
    $_SESSION['logged_in'] = FALSE;
    $_SESSION['user'] = NULL;
    header('Location: index.php');
}
if(isset($_SESSION['checkoutInfo'])){
    $_SESSION['checkoutInfo'] = NULL;
}
else{
    header('Location: index.php');
}