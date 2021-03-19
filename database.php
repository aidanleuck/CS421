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
        }
        


    }
}