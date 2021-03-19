<?php
session_start();

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
    $_SESSION['logged_in'] = FALSE;
    header('Location: index.php');
}
else{
    header('Location: index.php');
}