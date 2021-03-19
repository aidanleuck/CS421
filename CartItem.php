<?php
Class CartItem{
    private $partID;
    private $imageSrc;
    private $partName;
    private $partDesc;
    private $stock;
    private $price;
    public function __construct($id, $imageSrc, $name, $desc, $stock, $price){
        $this->partID = $id;
        $this->partName = $name;
        $this->partDesc = $desc;
        $this->stock = $stock;
        $this->price = $price;
        $this->imageSrc = $imageSrc;
    }
    public function getID(){
        return $this->partID;
    }

    public function displayItem(){

        echo '
        <div id = "container">
            <div id = "cart-row">
                <div id = "inner-cart">
                <div id = "image">
                    <img src = '.$this->imageSrc.' class ="image-pic"></img>
                </div>
                <div id = "align">
                    <div id = "description">
                        <p>'.$this->partDesc .'</p>
                    </div>
                </div>
                <div id = "quantity">
                    <select name = "number" id = "quantitySelect">';
                         for ($i=0; $i < $this->stock; $i++) 
                        { 
                            echo '<option value = '.$i.'>'.$i. '</option>';
                        }
                    echo '
                    </select>
                </div>
                
            </div>
            <div id = "price">'.$this->price .'</div>
            </div>
            <hr></hr>';
    }
}