<?php
include("../config.php");

$db = new DB_Connect();
$con = $db->connect();

$token = $_POST["token"];
$departmentId = $_POST["departmentId"];

$result["status"] = "false";
$result["status_message"] = "Token Invalid";

if($db->validateToken($con, $token)){
    $sql_query = "SELECT id, emp_name
                    FROM `staff_master`
                    WHERE dep_id = $departmentId
                    AND `status` = 1
                    ORDER BY emp_name";
    
    $res = mysqli_query($con, $sql_query);

    $result["status"] = "false";
    $result["status_message"] = "No Entry Found";
    
    while($row = mysqli_fetch_array($res)){
        $result["results"][] = array("employeeId"=>$row["id"],
                                    "empName"=>$row["emp_name"]
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