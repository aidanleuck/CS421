<?php
    include 'database.php';
    if(isset($_POST['searchVal']) && $_POST['searchVal'] !== ""){
        $dao = new Database();
        $result = $dao->searchParts($_POST['searchVal']);
        session_start();
        $_SESSION['searchResults'] = $result;
        header('Location: searchResults.php');
    }
    else{
        header('Location: '. $_SERVER['HTTP_REFERER']);
    }
?>