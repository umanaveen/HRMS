<?php
include("../config.php");

$db = new DB_Connect();
$con = $db->connect();

$userName = $_POST["userName"];
$password = $_POST["password"];
 
$sql_query = "SELECT zum.status, 
					zum.candidate_id,
					sm.emp_name, 
					zum.email_id, 
					zdm.id AS dept_id, 
					zdm.dept_name, 
					zum.user_group_code AS role_id, 
					zrm.role_name
					
				FROM `z_user_master` AS zum 
				JOIN `z_role_master` AS zrm ON zum.user_group_code = zrm.code
				JOIN `staff_master` AS sm ON zum.candidate_id = sm.candid_id
				JOIN `z_department_master` AS zdm ON zdm.id = sm.dep_id
				WHERE `user_name` = '".$userName."' AND `password` = '".$password."'";
 
$res = mysqli_query($con, $sql_query);
 
$result = array("status"=>"false", "status_message"=>"Username or Password Invalid");
 
while($row = mysqli_fetch_array($res)){
	if($row["status"] == 1){
		$result["userDetails"] = array("candidateId"=>$row["candidate_id"],
					"empName"=>$row["emp_name"],
					"email"=>$row["email_id"],
					"deptId"=>$row["dept_id"],
					"deptName"=>$row["dept_name"],
					"roleId"=>$row["role_id"],
					"roleName"=>$row["role_name"]
				);
	}
}

if(!empty($result["userDetails"])){
	$result["status"] = "true";
	unset($result["status_message"]);

	$candidateId = $result["userDetails"]["candidateId"];
	$token = md5(rand(100000, 1000000));

	$sql_query = "INSERT INTO `api_tokens` 
					(`candidate_id`, `token`)
					VALUES ($candidateId, '".$token."') ON DUPLICATE KEY UPDATE
					`token` = '".$token."',
					`status` = 1,
					`modified_on` = now()";

	mysqli_query($con, $sql_query);

	$result["token"] = $token;
}
 
echo json_encode($result);
 
mysqli_close($con);
?>