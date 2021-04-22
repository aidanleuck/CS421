<?php


include 'database.php';
include 'user.php';
session_start();
$dao = new Database();

if(isset($_POST['make']) && isset($_POST['year']) && isset($_POST['model'])){
     $dao->addVehicle($_POST['make'], $_POST['model'], $_POST['year'], $_SESSION['user']->getAccountID());
     header('Location: manageVehicle.php');
}
header('Location: manageVehicle.php');