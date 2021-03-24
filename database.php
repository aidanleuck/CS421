<?php
require 'KLogger.php';

 class Database{
    private $dsn = 'mysql:dbname=qfw;host=127.0.0.1';
    private $user = 'root';
    private $password = '';
    protected $logger;

    public function __construct(){
        $this->logger = new KLogger("logs/log.txt", KLogger::DEBUG);
    }
    private function makeConnection(){
        
        try{
            return new PDO($this->dsn, $this->user, $this->password);
        }
        catch(PDOException $exception){
            $this->logger->LogFatal("Database connection failed! " . $exception);
            
        }

    }
    public function verifyLogin($email, $password){
        $conn = $this->makeConnection();
        try{
            $q = $conn->prepare("SELECT count(*) as total FROM Account WHERE email = :email AND password = :pass");
            $q->bindParam(':email', $email);
            $q->bindParam(':pass', $password);
            $q->execute();
            $row = $q->fetch();

            if($row['total'] == 1){
                $this->logger->LogInfo("User found!" . print_r($row, 1));
                return true;
            }
            else{
                return false;
            }

        }
        catch(Exception $e){
            $this->logger->LogWarn($e);
            exit;
        }
        


    }

    public function deleteCart($uid){
        $conn = $this->makeConnection();
        try{
            $q = $conn->prepare("Delete FROM Cart WHERE accountID = :uid");
            $q->bindParam(':uid', $uid);
            $q->execute();
            $this->logger->LogDebug('Deleting entire cart for user'. $uid);
        }
        catch(Exception $e){
            $this->logger->LogWarn(print_r($e, 1));
            exit;
        }
        
    }
    public function deletePartialCart($uid, $partID){
        $conn = $this->makeConnection();
        try{
            $q = $conn->prepare("Delete FROM Cart WHERE accountID = :uid and partID = :partID");
            $q->bindParam(':uid', $uid);
            $q->bindParam(':partID', $partID);
            $q->execute();
            $this->logger->LogDebug('Deleting cart item '.$partID. ' for user'. $uid);
        }
        catch(Exception $e){
            $this->logger->LogWarn(print_r($e, 1));
            exit;
        }
    }

    public function inCart($partID, $userID){
        $conn = $this->makeConnection();

        try{
            $q = $conn->prepare("Select count(*) as total From Cart WHERE partID = :partID and accountID = :userID");
            $q->bindParam(':partID', $partID);
            $q->bindParam(':userID', $userID);
            $q->execute();
            $row = $q->fetch();

            if($row['total']){
                $this->logger->LogDebug("Found row in cart for " .$partID . "and user " .$userID);
                return true;
            }
            return false;
        }
        catch(Exception $e){
            $this->logger->LogWarn(print_r($e, 1));
            exit;
        }
    }

    public function verifyPart($partID){
        $conn = $this->makeConnection();

        try{
            $q = $conn->prepare("Select count(*) as total From Part WHERE partID = :partID");
            $q->bindParam(':partID', $partID);
            $q->execute();
            $row = $q->fetch();

            if($row['total']){
                $this->logger->LogDebug("Found row for part " .$partID);
                return true;
            }
            return false;
        }
        catch(Exception $e){
            $this->logger->LogWarn(print_r($e, 1));
            exit;
        }
    }
    

    public function getPartInfo($id){
        $conn = $this->makeConnection();

        try{
            $q = $conn->prepare("Select * From Part WHERE partID = :partID");
            $q->bindParam(':partID', $id);
            $q->execute();
            $row = $q->fetch();

            if($row){
                $this->logger->LogDebug("Found row for part " . $id);
                return $row;
            }
            else{
                header('Location: index.php');
                exit;

            }
            
        }
        catch(Exception $e){
            $this->logger->LogWarn(print_r($e, 1));
            exit;
        }
    }

    private function getFeaturedProducts(){
        $conn = $this->makeConnection();
        try{
            $sql = "SELECT * FROM Part";
            $result = $conn->query($sql, PDO::FETCH_ASSOC);

        }
        catch(Exception $e){
            $this->logger->LogWarn(print_r($e, 1));
            exit;
        }
        return $result->fetchAll();
    }
    public function printFeatured(){
        $products = $this->getFeaturedProducts();
        foreach($products as $product){
            echo'<div id ="product">
                    <img src = "'.$product["imageSrc"].'" class = "responsive">
                    <div id = "desc"><a href = "">'.$product['partName'].'</a></div>
                    <div id = "price">$'. $product['price'].'</div>
                    <div id = "button">
                        <form method = "post" action = "cart.php">
                        <button class = "atc">Add to Cart</button>
                        <input type = "hidden" name = "id" value = "'.$product["partID"].'"></input>
                        </form>

                    </div>
                </div>';
        }
        
    }
    public function addToCart($accountID, $partID){
        if(!($this->inCart($partID, $accountID))){
            $conn = $this->makeConnection();
            try{
                $this->logger->LogDebug("Inserting Part: " . $partID . 'for account: ' . $accountID);
                $q = $conn->prepare("INSERT INTO Cart (accountID, partID) VALUES (:accountID, :partID)");
                $q->bindParam(':accountID', $accountID);
                $q->bindParam(':partID', $partID);
                $q->execute();
            }
            catch(Exception $e){
                $this->logger->LogWarn($e);
            }

        }
        
    }
    public function getCart($accountID){
        $conn = $this->makeConnection();
        try{
            $q = $conn->prepare("SELECT partID From Cart WHERE accountID = :accountID");
            $q->bindParam(':accountID', $accountID);
            $q->execute();
            $row = $q->fetchAll();

            if($row){
                $this->logger->LogDebug("Found cart for account " .$accountID);
                return $row;
            }
            else{
                $this->logger->LogDebug("No rows exist in the cart for account ". $accountID);
            }
        }
        catch(Exception $e){
            $this->logger->LogWarn(print_r($e, 1));
            exit;
        }
    }
    public function getUserID($email, $password){
        $conn = $this->makeConnection();
        try{
            $q = $conn->prepare("SELECT accountID From Account WHERE email = :email AND password = :pass");
            $q->bindParam(':email', $email);
            $q->bindParam(':pass', $password);
            $q->execute();
            $row = $q->fetch();

            if($row){
                $this->logger->LogDebug("Found id for account " .$email);
                return $row;
            }
            else{
                $this->logger->LogDebug("User does not exist for account ". $email);
            }
        }
        catch(Exception $e){
            $this->logger->LogWarn(print_r($e, 1));
            exit;
        }
    }
    

}