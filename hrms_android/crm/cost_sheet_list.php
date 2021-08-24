<?php
include("../config.php");

$db = new DB_Connect();
$con = $db->connect();

$token = $_POST["token"];
$candidateId = $_POST["candidateId"];

$result = array("status"=>"false", "status_message"=>"Token Invalid");


if($db->validateToken($con, $token)){
    $sql_query1 = "SELECT e.id,
                    (SELECT name 
                        FROM `calls_master`
                        WHERE id = e.Call_type) AS call_type,
                    e.date,
                    e.Company_name,
                    e.Location,
                    e.Mobile,
                    e.Follup,
                    (SELECT `dept_name`
                        FROM `z_department_master`
                        WHERE id = e.Department) AS department,
                    (SELECT CONCAT(first_name, ' ', last_name) 
                        FROM `candidate_form_details` 
                        WHERE id = e.employee) AS employee,
                    (SELECT status_message 
                        FROM `android_status_master` 
                        WHERE category = 2 
                        AND role_code = 0
                        AND status_id = e.status) AS `status`

                    FROM `enquiry` AS e";

    $sql_query2 = "SELECT `user_group_code` 
                        FROM `z_user_master` 
                        WHERE `candidate_id` = $candidateId";

    $res2 = mysqli_query($con, $sql_query2);

    $result["status"] = "false";
    $result["status_message"] = "No Entry Found";

    $userPresent = FALSE;
    while($row = mysqli_fetch_array($res2)){
        $roleId = $row["user_group_code"];
        $userPresent = TRUE;
        if($roleId == 'R007' || $roleId == 'R006'|| $roleId == 'R005'){
            $sql_query1 = $sql_query1 . " WHERE e.employee = $candidateId 
                                            AND e.status IN (4, 5, 6, 7) 
                                            AND e.flag = 2
                                            ORDER BY e.id DESC";
        }else if($roleId == 'R001' || $roleId == 'R002'|| $roleId == 'R016'){
            $sql_query1 = $sql_query1 . " WHERE e.status IN (4, 5, 6, 7)
                                             AND e.flag = 2
                                             ORDER BY e.id DESC";
        }
    }
   
    if($userPresent){
        $res1 = mysqli_query($con, $sql_query1);
        
        while($row = mysqli_fetch_array($res1)){
            $result["results"][] = array("enquiryId"=>$row["id"],
                                        "callType"=>$row["call_type"],
                                        "date"=>$row["date"],
                                        "companyName"=>$row["Company_name"],
                                        "location"=>$row["Location"],
                                        "contactNumber"=>$row["Mobile"],
                                        "followUpDate"=>$row["Follup"],
                                        "department"=>$row["department"],
                                        "employee"=>$row["employee"],
                                        "status"=>$row["status"]
                                    );
        }
    }
}

if(!empty($result["results"])){
    $result["status"] = "true";
    unset($result["status_message"]);
}
 
echo json_encode($result);
 
mysqli_close($con);
?>