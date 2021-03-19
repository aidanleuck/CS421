<html>
    <head>
    <link rel="stylesheet" href="main.css">
    <?php
    include "stylesheets.php"
    ?>
    </head>
    <?php
    include "nav.php"
    ?>
    <?php 
        require_once 'cartList.php';
        $cart = new CartList();
        $cart->addCartItem(new CartItem(1, 'test', 'test', 'test', 'test', 1, 15.99));
        $cart->addCartItem(new CartItem(2, 'test2', 'test2', 'test2', 'test2', 1, 15.99));
       
        $cart->removeCartItem(2);
        print_r($cart );
        
    ?>
    <body>
        <div id = "container">
            <h1 class = "shipping">Free Shipping Now Available!</h1>

            <h2 class = "heading">Featured Products</h2>

            <div id = "product-row">
                <div id ="product">
                    <img src = "images/air-filter.jpg" class = "responsive">
                    <div id = "desc"><a href = "">Subaru Outback Air Filter</a></div>
                    <div id = "price">$22.99</div>
                    <div id = "button">
                        <button class = "atc">Add to Cart</button>
                    </div>
                </div>
                <div id ="product">
                    <img src = "images/air-filter.jpg" class = "responsive">
                    <div id = "desc"><a href = "">Subaru Outback Air Filter</a></div>
                    <div id = "price">$22.99</div>
                    <div id = "button">
                        <button class = "atc">Add to Cart</button>
                    </div>
                </div>

                <div id ="product">
                    <img src = "images/air-filter.jpg" class = "responsive">
                    <div id = "desc"><a href = "">Subaru Outback Air Filter</a></div>
                    <div id = "price">$22.99</div>
                    <div id = "button">
                        <button class = "atc">Add to Cart</button>
                    </div>

                </div>

                <div id ="product">
                    <img src = "images/air-filter.jpg" class = "responsive">
                    <div id = "desc"><a href = "">Subaru Outback Air Filter</a></div>
                    <div id = "price">$22.99</div>
                    <div id = "button">
                        <button class = "atc">Add to Cart</button>
                    </div>

                </div>

                <div id ="product">
                    <img src = "images/air-filter.jpg" class = "responsive">
                    <div id = "desc"><a href = "">Subaru Outback Air Filter</a></div>
                    <div id = "price">$22.99</div>
                    <div id = "button">
                        <button class = "atc">Add to Cart</button>
                    </div>

                </div>
            </div>
            <h2 class ="heading">Recommended For You</h2>

            <div id = "product-row">
            <div id ="product">
                    <img src = "images/air-filter.jpg" class = "responsive">
                    <div id = "desc"><a href = "">Subaru Outback Air Filter</a></div>
                    <div id = "price">$22.99</div>
                    <div id = "button">
                        <button class = "atc">Add to Cart</button>
                    </div>
                </div>
                <div id ="product">
                    <img src = "images/air-filter.jpg" class = "responsive">
                    <div id = "desc"><a href = "">Subaru Outback Air Filter</a></div>
                    <div id = "price">$22.99</div>
                    <div id = "button">
                        <button class = "atc">Add to Cart</button>
                    </div>
                </div>

                <div id ="product">
                    <img src = "images/air-filter.jpg" class = "responsive">
                    <div id = "desc"><a href = "">Subaru Outback Air Filter</a></div>
                    <div id = "price">$22.99</div>
                    <div id = "button">
                        <button class = "atc">Add to Cart</button>
                    </div>

                </div>

                <div id ="product">
                    <img src = "images/air-filter.jpg" class = "responsive">
                    <div id = "desc"><a href = "">Subaru Outback Air Filter</a></div>
                    <div id = "price">$22.99</div>
                    <div id = "button">
                        <button class = "atc">Add to Cart</button>
                    </div>

                </div>

                <div id ="product">
                    <img src = "images/air-filter.jpg" class= "responsive"> 
                    <div id = "desc"><a href = "">Subaru Outback Air Filter</a></div>
                    <div id = "price">$22.99</div>
                    <div id = "button">
                        <button class = "atc">Add to Cart</button>
                    </div>

                </div>
            </div>
            <h2 class = "heading">Fits your Vehicle</h2>
            <div id = "product-row">
            <div id ="product">
                    <img src = "images/air-filter.jpg" class = "responsive">
                    <div id = "desc"><a href = "">Subaru Outback Air Filter</a></div>
                    <div id = "price">$22.99</div>
                    <div id = "button">
                        <button class = "atc">Add to Cart</button>
                    </div>
                </div>
                <div id ="product">
                    <img src = "images/air-filter.jpg" class = "responsive">
                    <div id = "desc"><a href = "">Subaru Outback Air Filter</a></div>
                    <div id = "price">$22.99</div>
                    <div id = "button">
                        <button class = "atc">Add to Cart</button>
                    </div>
                </div>

                <div id ="product">
                    <img class = "responsive" src = "images/air-filter.jpg">
                    <div id = "desc"><a href = "">Subaru Outback Air Filter</a></div>
                    <div id = "price">$22.99</div>
                    <div id = "button">
                        <button class = "atc">Add to Cart</button>
                    </div>

                </div>

                <div id ="product">
                    <img class = "responsive" src = "images/air-filter.jpg">
                    <div id = "desc"><a href = "">Subaru Outback Air Filter</a></div>
                    <div id = "price">$22.99</div>
                    <div id = "button">
                        <button class = "atc">Add to Cart</button>
                    </div>

                </div>

                <div id ="product">
                    <img class = "responsive" src = "images/air-filter.jpg">
                    <div id = "desc"><a href = "">Subaru Outback Air Filter</a></div>
                    <div id = "price">$22.99</div>
                    <div id = "button">
                        <button class = "atc">Add to Cart</button>
                    </div>

                </div>
            </div>
</div>

           

</div>
     

    </body>
</html>

<?php
include "footer.php"
?>