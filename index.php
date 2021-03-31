<html>
    <head>
    <link rel="stylesheet" href="mairn.css">
    <?php
    include "stylesheets.php";
    ?>
    </head>
    <?php
    include "nav.php"
    ?>
    <body>
        <div id = "container">
            <div id = "shipping">
                <h1 class = "shipping">Free Shipping Now Available!</h1>
            </div>

            <h2 class = "heading">Featured Products</h2>

            <div id = "product-row">
                <?php 
                require_once 'database.php';
                $dao = new Database();
                $dao->printFeatured();
                ?>
            </div>
            <h2 class ="heading">Recommended For You</h2>
            <div id ="product-row">
            <?php 
                require_once 'database.php';
                $dao = new Database();
                $dao->printFeatured();
                ?>
            </div>
           <!-- Will be reimplemented in JQuery Assignment When Vehicles can be added
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

                </div> -->
            </div>
</div>

           

</div>
     

    </body>
</html>

<?php
include "footer.php"
?>