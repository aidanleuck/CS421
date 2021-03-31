<?php
include 'stylesheets.php';
include 'nav.php';

?>
<html>
<head><link rel="stylesheet" href="orders.css?v="></head>

<body>
    <div id = "container">
        <div id = "headerBar">
            <h2>Your Orders</h2>
            <div id = "orders_row">
                <div id = "orderID">Order Number: 4343243243242</div>
                <div id = "date">Order Date: August 12, 1999</div>
            </div>
        </div>

      

        <div id = "products">
            <div id = "product">
                <div id = "inner-product">

                <div id = "image"><img src = "images/air-filter.jpg"></div>
                    <div id = "align">
                    <div id = "desc">4 X Subaru Outback Air Filter @ $22.99</div>
                    
                    </div>
                    <div id = "partTotal">$90.90</div>
                    
                </div>
                </div>

                <div id = "product">
                <div id = "inner-product">

                <div id = "image"><img src = "images/air-filter.jpg"></div>
                    <div id = "align">
                    <div id = "desc">4 X Subaru Outback Air Filter @ $22.99</div>
                    
                    </div>
                    <div id = "partTotal">$90.90</div>
                    
                </div>
                </div>
               
               
            </div>
            <div id = "right">
                <h2>Order Total: $90.90</h2>
            </div>

            <hr></hr>
        </div>

        

        </div>
    
    </div>
</body>
</html>


<?php include 'footer.php'?>