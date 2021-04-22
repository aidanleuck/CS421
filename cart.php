<html>
    <head>
        <?php include "stylesheets.php" ?>
        <link rel = "stylesheet" href = "carn.css?v=">
        <script src = "JS/cart.js"></script>
    </head>

    <body>
    <?php 
       
        
       include 'cartList.php';
        include "nav.php";
      
        $dao = new Database();
     
        
            if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
                
                if(isset($_SESSION['cart'])){
                    foreach($_SESSION['cart']->returnCart() as $item){
                        $dao->addToCart($_SESSION['user']->getAccountID(), $item->getID());
    
                }
                $_SESSION['cart'] = NULL;
            }
                    $cartInfo = $dao->getCart($_SESSION['user']->getAccountID());
                    $cart = new CartList();
                    if($cartInfo){
                       foreach($cartInfo as $cartI){
                            $result = $dao->getPartInfo($cartI['partID']);
                            $cartPart= new CartItem($result['partID'], $result['imageSrc'],
                            $result['partName'], $result['partDesc'], $result['stock'], $result['price']);
                            $cart->addCartItem($cartPart);
                         
                  
                    
                    }

                    

            }
            $cart->printCart();
        }
            else{
                if(isset($_SESSION['cart'])){
                    $_SESSION['cart']->printCart();
                }
                else{
                    $_SESSION['cart'] = new CartList();
                    $_SESSION['cart']->printCart();
                }
                
            }
        
                
                   
                
                
    

        
            
        
        ?>
        
        <?php include "footer.php" ?>
    </body>
</html>