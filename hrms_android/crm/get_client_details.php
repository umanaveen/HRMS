<?php
include("../config.php");

$db = new DB_Connect();
$con = $db->connect();

$token = $_POST["token"];
$clientId = $_POST["clientId"];

$result["status"] = "false";
$result["status_message"] = "Token Invalid";

if($db->validateToken($con, $token)){
    $sql_query = "SELECT CONCAT(cm.address1, ', ', cm.address2, ', ', cm.area, ', ', cm.town_city, '-', cm.pincode) AS `address`,
                        cm.town_city,
                        cm.client_name,
                        cm.designation,
                        cm.mobile_no1,
                        cm.email_id1,
                        (SELECT dept_name FROM `z_department_master` WHERE id = cm.department_id) AS dept_name,
                        (SELECT emp_name FROM `staff_master` WHERE id = cm.employee_id) AS emp_name

                    FROM `client_master` AS cm 
                    WHERE cm.id = $clientId";
    
    $res = mysqli_query($con, $sql_query);

    $result["status"] = "false";
    $result["status_message"] = "No Entry Found";
    
    while($row = mysqli_fetch_array($res)){
        $result["clientDetails"] = array("address"=>$row["address"],
                                    "city"=>$row["town_city"],
                                    "clientName"=>$row["client_name"],
                                    "designation"=>$row["designation"],
                                    "mobileNo"=>$row["mobile_no1"],
                                    "email"=>$row["email_id1"],
                                    "deptName"=>$row["dept_name"],
                                    "empName"=>$row["emp_name"]
                                );
    }
}

if(!empty($result["clientDetails"])){
    $result["status"] = "true";
    unset($result["status_message"]);
}
 
echo json_encode($result);
 
mysqli_close($con);
?>