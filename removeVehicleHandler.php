<?php
include 'database.php';
include 'user.php';
session_start();
$dao = new Database();
echo $_GET['vID'];
$dao->deleteUserVehicle($_SESSION['user']->getAccountID(), $_GET['vID']);