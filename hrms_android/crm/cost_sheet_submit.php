<?php
include("../config.php");

$db = new DB_Connect();
$con = $db->connect();

$token = $_POST["token"];
$enquiryId = $_POST["enquiryId"];
$isApproved = $_POST["isApproved"];

$result["status"] = "false";
$result["status_message"] = "Token Invalid";

$status = 4;
if($isApproved == "true"){
    $status = 5;
}else if($isApproved == "false"){
    $status = 6;
}

if($db->validateToken($con, $token)){
    $sql_query = "UPDATE `enquiry`
                    SET `status` = $status
                    WHERE id = $enquiryId";
    
    if ($con->query($sql_query) === TRUE) {
        $result["status"] = "true";
        unset($result["status_message"]);
    } else {
        $result["status"] = "false";
        $result["status_message"] = "Update Failed";
    }
}
 
echo json_encode($result);
 
mysqli_close($con);
?>