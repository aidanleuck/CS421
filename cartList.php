<?php
require_once 'CartItem.php';

Class CartList{
    private $cartItems;

    public function __construct(){
        $this->cartItems = array();
    }
    public function addCartItem(CartItem $item){
        array_push($this->cartItems, $item);
    }
    public function removeCartItem($id){
        $counter = 0;
        foreach($this->cartItems as $i ){
            if($i->getID() == $id){
                unset($this->cartItems[$counter]);
            }
            $counter++;
        }
    }
}