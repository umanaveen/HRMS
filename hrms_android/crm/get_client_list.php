<?php
include("../config.php");

$db = new DB_Connect();
$con = $db->connect();

$token = $_POST["token"];

$result["status"] = "false";
$result["status_message"] = "Token Invalid";

if($db->validateToken($con, $token)){
    $sql_query = "SELECT id, `org_name`
                     FROM `client_master`
                     ORDER BY org_name";
    
    $res = mysqli_query($con, $sql_query);

    $result["status"] = "false";
    $result["status_message"] = "No Entry Found";
    
    while($row = mysqli_fetch_array($res)){
        $result["clientNames"][] = array("clientId"=>$row["id"],
                                        "companyName"=>$row["org_name"]
                                        );
    }
}

if(!empty($result["clientNames"])){
    $result["status"] = "true";
    unset($result["status_message"]);
}
 
echo json_encode($result);
 
mysqli_close($con);
?>