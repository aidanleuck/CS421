<html>
    <head>
        <?php include "stylesheets.php" ?>
        <link rel = "stylesheet" href = "ct.css">
    </head>

    <body>
    <?php 
        include 'database.php';
        include 'user.php';
        include 'cartList.php';
        include "nav.php";

        $dao = new Database();
        
        if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] === FALSE ){
            if(!isset($_SESSION['cart'])){
                $_SESSION['cart'] = new CartList();
            }
            if(isset($_POST['id'])){
                $currentList = $_SESSION['cart'];
                $result = $dao->getPartInfo($_POST['id']);
                $cart= new CartItem($result['partID'], $result['imageSrc'],
                $result['partName'], $result['partDesc'], $result['stock'], $result['price']);
                $currentList->addCartItem($cart);
                $_SESSION['cart'] = $currentList;
            }
            $_SESSION['cart']->printCart();

        }
        else{
            if(isset($_SESSION['cart'])){
            
                foreach($_SESSION['cart']->returnCart() as $item){
                    $dao->addToCart($_SESSION['user']->getAccountID(), $item->getID());

                }
                $_SESSION['cart'] = NULL;
                
            }
            if(isset($_POST['id'])){
                if($dao->verifyPart($_POST['id'])){
                    $dao->addToCart($_SESSION['user']->getAccountID(), $_POST['id']);

                }
                else{
                    header('Location: index.php');
                    exit;
                }
            
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
        
        ?>
        
        <?php include "footer.php" ?>
    </body>
</html>