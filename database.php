<?php
require 'KLogger.php';

 class Database{
    
    private $dsn;
    private $user;
    private $password;
    protected $logger;

    public function __construct(){
        $this->logger = new KLogger("logs/log.txt", KLogger::DEBUG);
        $url = parse_url("mysql://b3ad4171a41e4e:000f8d66@us-cdbr-east-03.cleardb.com/heroku_67195a60087b2ce?reconnect=true");
        $this->user = $url["user"];
        $this->password = $url["pass"];
        $db = substr($url["path"], 1);
        $host = $url['host'];

        $this->dsn = "mysql:dbname=heroku_67195a60087b2ce;host=us-cdbr-east-03.cleardb.com";
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

    public function deleteUserVehicle($uid, $vID){
        $conn = $this->makeConnection();
        try{
            $q = $conn->prepare("Delete FROM accountVehicle WHERE accountID = :uid and vehicleID = :vID");
            $q->bindParam(':uid', $uid);
            $q->bindParam(':vID', $vID);
            $q->execute();
            $this->logger->LogDebug('Deleting vehicle from user'. $uid);
        }
        catch(Exception $e){
            $this->logger->LogWarn(print_r($e, 1));
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
    public function searchParts($searchString){
        $conn = $this->makeConnection();
        $searchString = "%{$searchString}%";
        try{
            $q = $conn->prepare("Select * From Part WHERE partID LIKE :partID or partName LIKE :partName");
            $q->bindParam(':partID', $searchString);
            $q->bindParam(':partName', $searchString);
            $q->execute();
            $row = $q->fetchAll();

            return $row;
        }
        catch(Exception $e){
            $this->logger->LogWarn(print_r($e, 1));
            exit;
        }
    }
    public function getAllMake(){
        $conn = $this->makeConnection();
        try{
            $q = $conn->prepare("Select DISTINCT make From Vehicle ORDER BY make ASC");
            $q->execute();
            $row = $q->fetchAll();

            return $row;
        }
        catch(Exception $e){
            $this->logger->LogWarn(print_r($e, 1));
            exit;
        }
    }
 
    public function getModel($make){
        $conn = $this->makeConnection();
        try{
            $q = $conn->prepare("Select DISTINCT model From Vehicle where make = :make ORDER BY model ASC");
            $q->bindParam(":make", $make);
            $q->execute();
            $row = $q->fetchAll();

            return $row;
        }
        catch(Exception $e){
            $this->logger->LogWarn(print_r($e, 1));
            exit;
        }
    }
    public function getYear($make, $model){
        $conn = $this->makeConnection();
        try{
            $q = $conn->prepare("Select year From Vehicle where model = :model and make = :make ORDER BY year ASC");
            $q->bindParam(":model", $model);
            $q->bindParam(":make", $make);
            $q->execute();
            $row = $q->fetchAll();

            return $row;
        }
        catch(Exception $e){
            $this->logger->LogWarn(print_r($e, 1));
            exit;
        }
    }

    public function printAllParts(){
        $parts = $this->getParts();
        foreach($parts as $part){
        echo'<tr>
            <form method = "post" action = "ATC_handler.php">
                    <td>'.$part['partID'].'</td>
                    <td>'.$part['partName'].'</td>
                    <td>'.$part['price'].'</td>
                    <input type = "hidden" name = "id" value = '.$part['partID'].'></input>
                    <td><button type = "submit" class = "atc">Add to Cart</button></td>
                </tr>
                </form>';
    }
}

    public function getParts(){
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

    public function getOrder($uid){
        $conn = $this->makeConnection();

        try{
            $q = $conn->prepare("SELECT * From Orders Where accountID = :uid");
            $q->bindParam(':uid', $uid);
            $q->execute();
            $row = $q->fetchAll();
            $this->logger->LogDebug("Found orders for user" .$uid);
            return $row;
    
        }
        catch(Exception $e){
            $this->logger->LogWarn(print_r($e, 1));
            exit;
        }
    }
    public function getVehicleID($make, $model, $year){
        $conn = $this->makeConnection();

        try{
            $q = $q = $conn->prepare("Select vehicleID From Vehicle WHERE make = :make and model = :model and year = :year");
            $q->bindParam(':make', $make);
            $q->bindParam(':model', $model);
            $q->bindParam(':year', $year);
            $q->execute();
            $row = $q->fetchAll();
            $this->logger->LogDebug("Found orders for user" .$make);
            return $row;
    
        }
        catch(Exception $e){
            $this->logger->LogWarn(print_r($e, 1));
            exit;
        }
    }
    public function getOrderInfo($oNum){
        $conn = $this->makeConnection();
        try{
            $q = $conn->prepare("SELECT Part.partName, Part.imageSrc, Part.Price, Order_Manifest.quantity From Order_Manifest JOIN Part ON Order_Manifest.partID = Part.partID Where Order_Manifest.orderNumber = :oNum");
            $q->bindParam(':oNum', $oNum);
            $q->execute();
            $row = $q->fetchAll();
            $this->logger->LogDebug("Found orders for " .$oNum);
            return $row;
    
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

    public function getVehiclesUser($userID){
        $conn = $this->makeConnection();
        try{
            $q = $conn->prepare("SELECT DISTINCT accountVehicle.vehicleID, vehicle.make, vehicle.model, vehicle.year From accountVehicle JOIN vehicle ON accountVehicle.vehicleID = vehicle.vehicleID Where accountVehicle.accountID = :accountID");
            $q->bindParam(':accountID', $userID);
            $q->execute();
            $row = $q->fetchAll();
            $this->logger->LogDebug("Found vehicles for " .$userID);
            return $row;
    
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
            $sql = "SELECT * FROM Part order by rand() limit 5";
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
                    <div id = "desc">'.$product['partName'].'</div>
                    <img src = "'.$product["imageSrc"].'" class = "responsive">
                    <div id = "product_info">
                    
                    <div id = "price">$'. $product['price'].'</div>
                    <div id = "info">'.$product['partDesc'].'</div>
                    <div id = "button">
                        <form method = "post" action = "ATC_handler.php">
                        <button class = "atc">Add to Cart</button>
                        <input type = "hidden" name = "id" value = "'.$product["partID"].'"></input>
                        </form>
                    </div>

                    </div>
                </div>';
        }
        
    }
    public function verifyVehicle($make, $model, $year){
        $conn = $this->makeConnection();

        try{
            $q = $conn->prepare("Select * From Vehicle WHERE make = :make and model = :model and year = :year");
            $q->bindParam(':make', $make);
            $q->bindParam(':model', $model);
            $q->bindParam(':year', $year);
            $q->execute();
            $row = $q->fetch();

            if($row){
                return $row;
            }
            else{
               return -1;

            }
            
        }
        catch(Exception $e){
            $this->logger->LogWarn(print_r($e, 1));
            exit;
        }
    }

    public function addVehicle($make, $model, $year, $accountID){
        $conn = $this->makeConnection();
            try{
                
                $row = $this->verifyVehicle($make, $model, $year);
                if($row != -1){
                    echo $row['vehicleID'];
                    $this->logger->LogDebug("Inserting Vehicle into account: " .$accountID);
                    $q = $conn->prepare("INSERT INTO  accountVehicle(accountID, vehicleID) VALUES (:accountID, :vehicleID)");
                    $q->bindParam(':accountID', $accountID);
                    $q->bindParam(':vehicleID', $row['vehicleID']);
                    $q->execute();
                }
                else{
                    return -1;
                }
               
            }
            catch(Exception $e){
                $this->logger->LogWarn($e);
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
    public function addUser($email, $password){
        $conn = $this->makeConnection();
            try{
                $this->logger->LogDebug("Creating user with email: " . $email);
                $q = $conn->prepare("INSERT INTO Account (email, password) VALUES (:email, :password)");
                $q->bindParam(':email', $email);
                $q->bindParam(':password', $password);
                $q->execute();
            }
            catch(Exception $e){
                $this->logger->LogWarn($e);
            }

    }
    public function getStock($partID){
        $conn = $this->makeConnection();
        try{
            $q = $conn->prepare("SELECT stock FROM Part Where partID = :partID");
            $q->bindParam(':partID', $partID);
          
            $q->execute();
            $row = $q->fetch();
            return $row;    

        }
        catch(Exception $e){
            $this->logger->LogWarn($e);
            exit;
        }
        
    }
    public function updateStock($partID, $quantity){
        $conn = $this->makeConnection();
        $result = $this->getStock($partID);
        try{
            $this->logger->LogDebug("Updating stock for '.$partID.'");
            $q = $conn->prepare("UPDATE Part SET stock = :newStock WHERE partID = :partID");
            $q->bindParam(':partID', $partID);
            $newStock = $result['stock'] - $quantity;
            $q->bindParam(':newStock', $newStock);

            $q->execute();
        }
        catch(Exception $e){
            $this->logger->LogWarn($e);
        }
    }
    public function addOrderManifest($orderNumber, $partID, $quantity){
        $conn = $this->makeConnection();
        try{
            $this->logger->LogDebug("Adding order_manifest for '.$orderNumber.'");
            $q = $conn->prepare("Insert Into Order_Manifest (orderNumber, partID, quantity) VALUES(:orderNumber, :partID, :quantity)");
            $q->bindParam(':orderNumber', $orderNumber);
            $q->bindParam(':partID', $partID);
            $q->bindParam(':quantity', $quantity);
            $q->execute();
        }
        catch(Exception $e){
            $this->logger->LogWarn($e);
        }
    }
    public function addOrder($orderID, $orderAmount, $accountID){
        $conn = $this->makeConnection();
        try{
            $this->logger->LogDebug("Adding order for '.$accountID.'");
            $q = $conn->prepare("Insert Into Orders (orderNumber, orderAmount, orderDate, accountID) VALUES(:orderID, :orderAmount, :date, :accountID)");
            $date = date("Y-m-d");
            $q->bindParam(':orderID', $orderID);
            $q->bindParam(':orderAmount', $orderAmount);
            $q->bindParam(':date', $date);
            $q->bindParam(':accountID', $accountID);
            
            $q->execute();
        }
        catch(Exception $e){
            $this->logger->LogWarn($e);
        }
    }
    public function updateUser($uID, $email, $address, $city, $state, $zip){
        $conn = $this->makeConnection();
        try{
            $this->logger->LogDebug("Updating Account '.$uID.'");
            $q = $conn->prepare("UPDATE Account SET email = :email, address = :address, city = :city, state = :state, zip = :zip WHERE accountID = :uid");
            $q->bindParam(':uid', $uID);
            $q->bindParam(':email', $email);
            $q->bindParam(':address', $address);
            $q->bindParam(':city', $city);
            $q->bindParam(':state', $state);
            $q->bindParam(':zip', $zip);
            $q->execute();
        }
        catch(Exception $e){
            $this->logger->LogWarn($e);
        }

    }
    public function getUserInfo($uid){
        $conn = $this->makeConnection();
        try{
            $q = $conn->prepare("SELECT state, city, zip, address From Account WHERE accountID = :uid");
            $q->bindParam(':uid', $uid);
            $q->execute();
            $row = $q->fetch();

            if($row){
                $this->logger->LogDebug("Found id for account " .$uid);
                return $row;
            }
            else{
                $this->logger->LogDebug("User does not exist for account ". $uid);
            }
        }
        catch(Exception $e){
            $this->logger->LogWarn(print_r($e, 1));
            exit;
        }
    }
    public function getUserByEmail($email){
        $conn = $this->makeConnection();
        try{
            $q = $conn->prepare("SELECT accountID From Account WHERE email = :email");
            $q->bindParam(':email', $email);
            $q->execute();
            $row = $q->fetch();

            if($row){
                $this->logger->LogDebug("Found id for account " .$email);
                return $row;
            }
            else{
                $this->logger->LogDebug("User does not exist for account ". $email);
                return FALSE;
            }
        }
        catch(Exception $e){
            $this->logger->LogWarn(print_r($e, 1));
            exit;
        }
    }
    public function getUserPassword($email){
        $conn = $this->makeConnection();
        try{
            $q = $conn->prepare("SELECT password From Account WHERE email = :email");
            $q->bindParam(':email', $email);
            $q->execute();
            $row = $q->fetch();

            if($row){
                $this->logger->LogDebug("Found id for account " .$email);
                return $row;
            }
            else{
                $this->logger->LogDebug("User does not exist for account ". $email);
                return FALSE;
            }
        }
        catch(Exception $e){
            $this->logger->LogWarn(print_r($e, 1));
            exit;
        }
    }
    public function getUserPasswordByID($uID){
        $conn = $this->makeConnection();
        try{
            $q = $conn->prepare("SELECT password From Account WHERE accountID= :id");
            $q->bindParam(':id', $uID);
           
            $q->execute();
            $row = $q->fetch();

            if($row){
                $this->logger->LogDebug("Found user info for account " .$uID);
                return $row;
            }
            else{
                $this->logger->LogDebug("User does not exist for account ". $uID);
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
    public function getUserByID($id){
        $conn = $this->makeConnection();
        try{
            $q = $conn->prepare("SELECT * From Account WHERE accountID= :id");
            $q->bindParam(':id', $id);
           
            $q->execute();
            $row = $q->fetch();

            if($row){
                $this->logger->LogDebug("Found user info for account " .$id);
                return $row;
            }
            else{
                $this->logger->LogDebug("User does not exist for account ". $id);
            }
        }
        catch(Exception $e){
            $this->logger->LogWarn(print_r($e, 1));
            exit;
        }
    }
    public function updatePassword($uid, $password){
        $conn = $this->makeConnection();
        try{
            $this->logger->LogDebug("Updating password for account '.$uid.'");
            $q = $conn->prepare("UPDATE Account SET password = :password WHERE accountID = :uid");
            $q->bindParam(':uid', $uid);
            $q->bindParam(':password', $password);
            $q->execute();
        }
        catch(Exception $e){
            $this->logger->LogWarn($e);
        }
    }
    

}