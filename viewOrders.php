<?php
include 'stylesheets.php';
include 'database.php';
include 'user.php';
include 'nav.php';




?>
<html>
<head><link rel="stylesheet" href="orders.css?c="></head>

<body>
    <div id = "container">
        <div id = "headerBar">
            <h2>Your Orders</h2>
        </div>

            <?php 
            $dao = new Database();
            $orders = $dao->getOrder($_SESSION['user']->getAccountID());
           
            foreach($orders as $order){
                echo '<div id = "headerBar-inner">
                <div id = "orders_row">
                    
                
                        <div id = "orderID">Order Number: '.$order['orderNumber'].'</div>
                        <div id = "date">';echo date('F j, Y', strtotime($order['orderDate'])).'</div>
                    </div>
                </div>';
        
            
            
     
        $orderInfo = $dao->getOrderInfo($order['orderNumber']);

        echo'<div id = "products">';
        
        foreach($orderInfo as $i){

        
        echo '
            <div id = "product">
                <div id = "inner-product">

                <div id = "image"><img src = "'.$i['imageSrc'].'"></div>
                    <div id = "align">
                    <div id = "desc">$'.$i["quantity"].' X Subaru Outback Air Filter @ '.$i['Price'].'</div>
                    
                    </div>
                    <div id = "partTotal">$'.number_format(($i["quantity"] * $i["Price"])* 1.06, 2).'</div>
                    
                </div>
                </div>';
            }
               
            echo'</div>
            <div id = "right">
                <h2>Order Total: $'.$order['orderAmount'].'</h2></div>';
    
            }
            
            

            

            ?>
        </div>

        

        </div>
    
    </div>
</body>

<?php include 'footer.php';?>
</html>

