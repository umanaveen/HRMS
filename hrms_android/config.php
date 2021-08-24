<?php
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "Best2020Know");
define("DB_DATABASE", "hrs");

class DB_Connect {
    public function connect() {
        $con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        return $con;
    }

    public function validateToken($con, $token){
        $sql_query = "SELECT * 
                FROM `api_tokens` 
                WHERE token = '" . $token . "' AND status = 1";

        $res = mysqli_query($con, $sql_query);  

        if(mysqli_num_rows($res) > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }
}

error_reporting(0);

?>