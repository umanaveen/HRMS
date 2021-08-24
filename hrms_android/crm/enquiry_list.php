<?php
include("../config.php");

$db = new DB_Connect();
$con = $db->connect();

$token = $_POST["token"];

$result = array("status"=>"false", "status_message"=>"Token Invalid");

if($db->validateToken($con, $token)){
    $sql_query = "SELECT e.id,
                    (SELECT name 
                        FROM `calls_master`
                        WHERE id = e.Call_type) AS call_type,
                    e.date,
                    e.Company_name,
                    e.Location,
                    e.Mobile,
                    e.Follup,
                    (SELECT CONCAT(first_name, ' ', last_name) 
                        FROM `candidate_form_details` 
                        WHERE id = e.employee) AS employee,
                    (SELECT status_message 
                        FROM `android_status_master` 
                        WHERE category = 2 
                        AND role_code = 0
                        AND status_id = e.status) AS `status`
                    
                FROM `enquiry` AS e
                ORDER BY e.id DESC";
    
    $res = mysqli_query($con, $sql_query);

    $result = array("status"=>"false", "status_message"=>"No Entry Found");
    
    while($row = mysqli_fetch_array($res)){
        $result["results"][] = array("enquiryId"=>$row["id"],
                                    "callType"=>$row['call_type'],
                                    "date"=>$row['date'],
                                    "client"=>$row['Company_name'],
                                    "location"=>$row['Location'],
                                    "contactNumber"=>$row['Mobile'],
                                    "followUpDate"=>$row['Follup'],
                                    "employee"=>$row['employee'],
                                    "status"=>$row["status"]
                                );
    }
}

if(!empty($result["results"])){
    $result["status"] = "true";
    unset($result["status_message"]);
}
 
echo json_encode($result);
 
mysqli_close($con);
?>