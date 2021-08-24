<?php
include("../config.php");

$db = new DB_Connect();
$con = $db->connect();

$token = $_POST["token"];

$callType = $_POST["callType"];
$date = $_POST["date"];
$clientType = $_POST["clientType"];
$consultantName = $_POST["consultantName"];
$companyName = $_POST["companyName"];
$location = $_POST["location"];
$address = $_POST["address"];
$client = $_POST["client"];
$designation = $_POST["designation"];
$mobile = $_POST["mobile"];
$email = $_POST["email"];
$product = $_POST["product"];
$feedback = $_POST["feedback"];
$followUp = $_POST["followUp"];
$department = $_POST["department"];
$employee = $_POST["employeeId"];
$createdBy = $_POST["createdBy"];
 
$result["status"] = "false";
$result["status_message"] = "Token Invalid";

if($db->validateToken($con, $token)){
    $sql_query = "INSERT INTO `enquiry`
                    (`Call_type`, 
                    `date`, 
                    `Client_type`, 
                    `consultant`,
                    `Company_name`,
                     `Location`, 
                     `Address`, 
                     `Client`, 
                     `Designation`, 
                     `Mobile`, 
                     `mail`, 
                     `Product`,
                     `Feedback`, 
                     `Follup`,
                     `Department`, 
                     `employee`,  
                     `created_by`)
                      VALUES
                     ('$callType',
                        '$date',
                        '$clientType',
                        '$consultantName',
                        '$companyName',
                        '$location',
                        '$address',
                        '$client',
                        '$designation',
                        '$mobile',
                        '$email',
                        '$product',
                        '$feedback',
                        '$followUp',
                        '$department',
                        '$employee',
                        '$createdBy')";
    
    if ($con->query($sql_query) === TRUE) {
        $result["status"] = "true";
        unset($result["status_message"]);
    } else {
        $result["status"] = "false";
        $result["status_message"] = "Insert Failed";
    }
    
}

echo json_encode($result);
 
mysqli_close($con);
?>