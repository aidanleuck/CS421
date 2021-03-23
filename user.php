<?php

Class User{
    private $accountID;
    private $email;

    public function __construct($id, $email){
        $this->accountID = $id;
        $this->email = $email;
    }

    public function getAccountID(){
        return $this->accountID;
    }
    public function getEmail(){
        return $this->email;
    }
    
}