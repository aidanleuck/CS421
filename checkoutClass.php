<?php
class checkOutData{
    private $idQuantity;
    

    public function __construct($array1, $array2){
        $this->idQuantity = array();

        for($i = 0; $i < count($array1); $i++){
            $this->idQuantity[$array1[$i]] = $array2[$i];
        }
           

    }
    public function getQuantity($id){
        return $this->idQuantity[$id];
    }
    public function getParts(){
        return array_keys($this->idQuantity);
    }
    public function calculateSubTotal(){
        $keys = array_keys($this->idQuantity);
        $subTotal = 0;
        $dao = new Database();
        foreach($keys as $key){
            $result = $dao->getPartInfo($key);
            $subTotal += ($result['price'] * $this->idQuantity[$key]);
        }
        return $subTotal;
    }
    public function getArray(){
        return $this->idQuantity;
    }
    public function calculateTax(){
        $subTotal = $this->calculateSubTotal();
        return round($subTotal * .06, 2);
    }

    public function getTotal(){
        return $this->calculateSubTotal() + $this->calculateTax();
    }
    


}