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
    public function returnCart(){
        return $this->cartItems;
    }
    public function printCart(){
        if(count($this->cartItems)){
            echo '<form action = "checkout.php" method = "post">
        <div id = "container">
        <h2 class = "cartTitle">Your Shopping Cart</h1>'
        ;
        foreach($this->cartItems as $i){
            $i->displayItem();
        }
        echo '
        <div id = "total">Subtotal: $'.$this->calculateTotal().'</div>
            <div id = "checkout">
               
                    <button class = "pay">Checkout</button>
                
            
        </div>';
        echo '</div></form>';
        }
        else{
            echo '<div id = "container"><h1>Your cart is empty</h1></div>';
        }
        
    }
    private function calculateTotal(){
        $total = 0;
        foreach($this->cartItems as $i){
            $total += $i->getPrice();
        }
        return $total;
    }
}