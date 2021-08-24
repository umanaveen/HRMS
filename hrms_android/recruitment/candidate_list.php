<?php
include("../config.php");

$db = new DB_Connect();
$con = $db->connect();

$token = $_POST["token"];

$result = array("status"=>"false", "status_message"=>"Token Invalid");

if($db->validateToken($con, $token)){
    $sql_query = "SELECT cfd.first_name, 
                        cfd.last_name, 
                        zdm.dept_name, 
                        dm.designation_name, 
                        cfd.phone, 
                        cfd.mail,
                        cfd.id AS cid,
                        cfd.status,
                        asm.status_message
                        
                    FROM `candidate_form_details` AS cfd 
                    LEFT JOIN `company_master` AS cm ON cfd.company_name = cm.id 
                    LEFT JOIN `designation_master` AS dm ON cfd.position = dm.id 
                    LEFT JOIN `z_department_master` AS zdm ON cfd.department = zdm.id
                    LEFT JOIN `android_status_master` AS asm ON cfd.status = asm.status_id
                    WHERE cfd.status IN (2, 3, 4, 5, 6, 7, 8, 9, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 30) 
                    AND asm.role_code = 0
                    AND asm.category = 1
                    ORDER BY cfd.id DESC";
    
    $res = mysqli_query($con, $sql_query);

    $result = array("status"=>"false", "status_message"=>"No Entry Found");
    
    while($row = mysqli_fetch_array($res)){
        $result["results"][] = array("firstName"=>$row["first_name"],
                    "lastName"=>$row["last_name"],
                    "deptName"=>$row["dept_name"],
                    "designationName"=>$row["designation_name"],
                    "phone"=>$row["phone"],
                    "email"=>$row["mail"],
                    "candidateId"=>$row["cid"],
                    "status"=>$row["status"],
                    "status_message"=>$row["status_message"]
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