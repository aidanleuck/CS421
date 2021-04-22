<?php
$pieces = explode(" ", $_POST["text"]);

$year = $pieces[0];
$make = $pieces[1];
$model = $pieces[2];

include "database.php";
session_start();
$dao = new Database();
$result = $dao->getVehicleID($make, $model, $year);
$_SESSION['selectedVehicle'] = $result[0]["vehicleID"];
?>