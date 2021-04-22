<?php 
include 'stylesheets.php';
include 'checkoutClass.php';
include 'nav.php';



if(!$_SESSION['logged_in']){
    header('Location:login.php');
}
if(!isset($_SESSION['checkoutInfo'])){
    header('Location: cart.php');
}
else{
$dao = new Database();

$keys = $_SESSION['checkoutInfo']->getParts(); 
  

foreach($keys as $key){
    if(!$dao->inCart( $key, $_SESSION['user']->getAccountID()) || $dao->getStock($key)[0] == 0) {
        header('Location:cart.php');
        exit;
    }
}
}



?>

<html>
    <head><link rel="stylesheet" href="checkout.css?u=<?php time()?>"></head>
    <body>
        <form method = "post" action = "order_handler.php">
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

                <div id = "order_summary">
                <div id ="headerBar"><h2>Order Summary</h2>
                </div>
                    <div id = "inner">
                    <?php 
                    $dao = new Database();
                    $keys = $_SESSION['checkoutInfo']->getParts();
                    foreach($keys as $key){
                        $result = $dao->getPartInfo($key);

                        echo '<h2>'.$_SESSION['checkoutInfo']->getQuantity($result['partID']).' X '.$result['partName'].' @ '.$result['price'].'</h2>';
                    }
                    ?>

                    </div>

                </div>

            </div>

            <div id = "checkout">
                <div id = "headerBar-center"><h2 class = "center">Submit Order</div>
                <div id = "checkoutContent">
                <div id = "checkoutAlign">
                    <span class = "checkoutLeft">Subtotal</span>
                    <span class = "checkoutRight">$<?php echo number_format($_SESSION['checkoutInfo']->calculateSubTotal(), 2) ?></span>
                </div>
                <div id = "checkoutAlign">
                    <span class = "checkoutLeft">Tax</span>
                    <span class = "checkoutRight">$<?php echo number_format($_SESSION['checkoutInfo']->calculateTax(), 2)?></span>
                </div>

                <div id ="checkoutAlign">
                    <span class = "checkoutLeft"><h2>Total</h2></span>
                    <span class = "checkoutRight"><h2>$<?php echo number_format($_SESSION['checkoutInfo']->getTotal(), 2) ?></h2></span>
                </div>
                <div id = "checkoutButton">
                <input type = "submit" class = "greenButton" name = "checkout" value = "Place Order"/>
                </div>
            </div>
            </div>

        </form>
    </body>
</html>