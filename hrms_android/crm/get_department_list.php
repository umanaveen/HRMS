<?php
include("../config.php");

$db = new DB_Connect();
$con = $db->connect();

$token = $_POST["token"];

$result["status"] = "false";
$result["status_message"] = "Token Invalid";

if($db->validateToken($con, $token)){
    $sql_query = "SELECT id, 
                        dept_name 
                    FROM `z_department_master`";
    
    $res = mysqli_query($con, $sql_query);

    $result["status"] = "false";
    $result["status_message"] = "No Entry Found";
    
    while($row = mysqli_fetch_array($res)){
        $result["departments"][] = array("departmentId"=>$row["id"],
                                    "deptName"=>$row["dept_name"]
                                );
    }
}

if(!empty($result["departments"])){
    $result["status"] = "true";
    unset($result["status_message"]);
}
 
echo json_encode($result);
 
mysqli_close($con);
?>