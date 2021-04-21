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
    public function getPrice(){
        return $this->price;
    }

    public function displayItem(){

        echo '
        
            <div id = "cart-row">
                <div id = "inner-cart">
                <div id = "imageCheck">
                    <div id = "check">
                        <input type = "checkbox" class = "sel" name = "partID[]" value = "'.$this->partID.'">
                    </div>

                    <div id = "image" >
                      <img src = '.$this->imageSrc.' class ="image-pic"></img>
                    </div>

                    
                    
                
            </div>
            <div id = "info">
            <input type = "hidden" name = "partIDCheckout[]" value = "'.$this->partID.'"/>
            <div id = "title">
                
                <h2 class = "product">'.$this->partName.'</h2>
            </div>';
            echo '<div id = "stock">';
            
                if($this->stock > 0){
                    echo '<span class = "in_stock">In Stock</span>';
                }
                else{
                    echo '<span class = "out_stock">Out of Stock</span>';
                }
            echo '
            <div id = "price">$'.$this->price.'</div>
            </div>

            <div id = "quantity">
                <label for "quantity">Qty</label>
                <select name = "quantity[]" id ="quantity">';
               

           

                for($i = 1; $i <= $this->stock; $i++){
                    echo '<option value = '.$i.'>'.$i.'</option>';
                }
                echo'</select>

                
                
            </div>


            <div id ="delete">
                <a id = "deleteLink" class = "deleteL" data='.urlencode($this->partID).' href = "delete_handler.php?pID='.urlencode($this->partID).'">Remove</a>
            </div>

            
           
            </div>


            
                        
            

            </div>

            
            </div>
            <hr></hr>';
    }
}