<?php 
include 'stylesheets.php';
include 'database.php';
include 'user.php';
include 'nav.php';

if(!$_SESSION['logged_in']){
    header('Location:login.php');
}

?>

<html>
    <head><link rel="stylesheet" href="checkout.css?v=<?time()?>"></head>
    <body>
        <form method = "post">
            <div id = "container">
                <div id ="headerBar"><h2>Checkout</h2></div>
                <div id = "shipping">
                    <div id = "headerBar">
                    <h4 class = "">Shipping Information</h4></div>
                    <?php 
                        $dao = new Database();
                        $addressInfo = $dao->getUserInfo($_SESSION['user']->getAccountID());
                        echo '<h5 class = "margin">Address: '.$addressInfo['address'].' </h5>';
                        echo '<h5 class = "margin">City: '.$addressInfo['city'].' </h5>';
                        echo '<h5 class = "margin">State: '.$addressInfo['state'].' </h5>';
                        echo '<h5 class = "margin">Zip Code: '.$addressInfo['zip'].' </h5>';

                    ?>
                    <div id = "center"><a href = "manageUserInfo.php">Blank or Incorrect? Click Here.</a></div>
                    
                </div>
                <div id = "payment">
                    <div id = "headerBar">
                        <h2>Payment Information</h2>
    
                    </div>
                    <h2>Payment will be implemented in the JQuery Assignment</h2>
                </div>

            </div>
        </form>
    </body>
</html>