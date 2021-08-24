<?php
include("../config.php");

$db = new DB_Connect();
$con = $db->connect();

$token = $_POST["token"];

$result = array("status"=>"false", "status_message"=>"Token Invalid");

if($db->validateToken($con, $token)){
    $sql_query = "UPDATE `api_tokens`
                    SET `status` = 0
                    WHERE `token` = '" . $token . "'";

    $res = mysqli_query($con, $sql_query);

    $result["status"] = "true";
    unset($result["status_message"]);
}

echo json_encode($result);

mysqli_close($con);
?>