<?php
require_once 'CartItem.php';
require_once 'KLogger.php';

Class CartList{
    private $cartItems;
    protected $logger;

    public function __construct(){

        $this->cartItems = array();
        $this->logger = new KLogger("logs/log.txt", KLogger::DEBUG);
    }
    public function addCartItem(CartItem $item){
        $this->cartItems[$item->getID()] = $item;

    }
    public function removeCartItem($id){
       unset($this->cartItems[$id]);
    }
    public function emptyCart(){
        $this->cartItems = array();
    }
    public function returnCart(){
        return $this->cartItems;
    }
    public function printCheckout(){
        echo '<div id = "checkout">
            <div id = "headerBar">
                <div id = "summaryTitle">
                    <h3 class = "totalCheck">Cart Summary</h3>
                </div>
            </div>
            <div id = "checkoutContent">
                <div id = "checkoutAlign">
                    <span class = "checkoutLeft">Subtotal</span>
                    <span class = "checkoutRight">$'.$this->calculateTotal().'</span>
                </div>
                <div id = "checkoutAlign">
                    <span class = "checkoutLeft">Total Discounts</span>
                    <span class = "checkoutRight">None Available</span>
                </div>
                <div id = "checkoutAlign">
                    <p class = "smallText">Taxes and shipping will be calculated during checkout. <a id = "link" href = "order-policy.php">Learn More</a> about our shipping policy here</p>
                </div>

                <div id ="checkoutAlign">
                    <span class = "checkoutLeft"><h2>EST. Total</h2></span>
                    <span class = "checkoutRight"><h2>$'.$this->calculateTotal().'</h2></span>
                </div>
                <div id = "checkoutButton">
                <input type = "submit" class = "greenButton" name = "checkout" value = "Checkout"/>
                </div>
            </div>
        </div>';
    }
    public function printCart(){
        

        if(count($this->cartItems)){
            
            echo '<form action = "cart_handler.php" method = "post">
            <div id = "body">
        <div id = "container">
            <div id = "cartHeader">
                <h2 class = "cartTitle">Your Shopping Cart</h1>
                <div class = "priceHeader">Price</div>
            </div>'
            ;
            foreach($this->cartItems as $i){
                $i->displayItem();
            }
            echo '
            <div id = "total">Subtotal: $'.$this->calculateTotal().'</div>
                <div id = "remove">
                    <input type = "submit" class = "removeAll" id = "removeSel" name = "deleteSelected" value = "Delete Selected"/>
                    <input type = "submit" name = "deleteAll" class = "removeAll" value = "Delete All"/>
                
            </div>';
          
        echo '</div></form>';
        $this->printCheckout();
        }
        else{
            echo '<div id = "container"><h1>Your cart is empty</h1></div>';
        }
        echo '</div>';

        
        
    }
    private function calculateTotal(){
        $total = 0;
        foreach($this->cartItems as $i){
            $total += $i->getPrice();
        }
        return $total;
    }
}