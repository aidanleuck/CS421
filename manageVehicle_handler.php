<?php

include 'database.php';
include 'user.php';
session_start();
$dao = new Database();


 if(isset($_POST['selectedMake']) && isset($_POST['selectedModel'])){
   
    if($_POST['selectedMake'] != "" && $_POST['selectedModel'] != ""){
       
        echo json_encode($dao->getYear($_POST['selectedMake'], $_POST['selectedModel'] ));
    }
    else if($_POST['selectedMake'] != ""){
        echo json_encode($dao->getModel($_POST['selectedMake']));
    }
}

