<?php 
include 'stylesheets.php';
include 'nav.php';
if(!$_SESSION['logged_in']){
    header('Location:index.php');
}
?>

<head>
<link rel="stylesheet" href="accoun.css?v=<?time()?>">
</head>

<div id = "container">
    <div id = "outer">
      
        <div id = "content">
            <div id ="headerBar">Vehicles</div>
            <div id = "inner-content">
                <a href = "manageVehicle.php" id = "link">Manage my Vehicles</a>
            </div>
        </div>
        <div id = "content">
            <div id = "headerBar">Account Mangement</div>
            <div id = "inner-content">
                <a href = "manageUserInfo.php" id = "link">Update User Information</a>
            </div>
            <div id = "inner-content">
                <a href = "updatePassword.php" id = "link">Update Password</a>
            </div>
        </div>
        <div id = "content">
            <div id = "headerBar">Orders</div>
            <div id = "inner-content">
                <a href = "" id = "link">View My Orders</a>
            </div>
        </div>
    </div>
        
</div>

<?php include 'footer.php'?>
