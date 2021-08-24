<?php

header("Access-Control-Allow-Origin: *");

define("Title", 'Recruitment');
try {
	$con = new pdo ('mysql:host=localhost;dbname=hrs','root','Best2020Know');
} 
catch (Exception $e) 
{
	echo $e->getMessage();
}


$IP = "http://192.168.200.89:8081";

class Database{
  
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "hrs";
    private $username = "root";
    private $password = "Best2020Know";
    public $conn;
  
    // get the database connection
    public function getConnection(){
  
        $this->conn = null;  
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }
        catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}
?>