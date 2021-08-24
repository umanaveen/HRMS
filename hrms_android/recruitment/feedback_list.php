<?php
include("../config.php");

$db = new DB_Connect();
$con = $db->connect();

$token = $_POST["token"];
$candidateId = $_POST["candidateId"];

$result = array("status"=>"false", "status_message"=>"Token Invalid");

// Function to select if the Add Feedback button should occur
function isAddFeedback($status){
    if($status == 3){
        return TRUE;
    }else {
        return FALSE;
    }
}

if($db->validateToken($con, $token)){

    $sql_query = "SELECT cfd.id,
                    cfd.first_name,
                    cfd.last_name,
                    dm.designation_name AS position,
                    (SELECT asm.status_message
                        FROM `android_status_master` AS asm
                        WHERE asm.role_code = 0
                        AND asm.category = 1
                        AND asm.status_id = cfd.status) AS head_status,
                    (SELECT asm.status_message
                        FROM `candidate_round_details` AS crd
                        JOIN `staff_master` AS sm ON sm.id = crd.person_id
                        JOIN `z_user_master` AS zum ON zum.candidate_id = sm.candid_id
                     	JOIN `android_status_master` AS asm ON asm.status_id = crd.status
                        JOIN `z_role_master` AS zrm ON asm.role_code = zrm.id
                        WHERE sm.candid_id = " . $candidateId . "
                     	AND crd.candid_id = cfd.id
                    	AND zrm.code = zum.user_group_code
                        AND asm.category = 1) AS `status`,
                        cfd.status AS button_status

                    FROM `candidate_form_details` AS cfd 
                    JOIN `designation_master` AS dm ON dm.id = cfd.position 
                    WHERE cfd.id IN (SELECT crd.candid_id 
                                        FROM `candidate_round_details` AS crd
                                        JOIN `staff_master` AS sm ON sm.id = crd.person_id
                                        JOIN `z_user_master` AS zum ON zum.candidate_id = sm.candid_id
                                        WHERE zum.candidate_id = " . $candidateId . ")
                    ORDER BY cfd.id DESC";
                    
    $res = mysqli_query($con, $sql_query);

    $result = array("status"=>"false", "status_message"=>"No Entry Found");
    
    while($row = mysqli_fetch_array($res)){
        $result["candidateList"][] = array("candidateId"=>$row["id"],
                                    "firstName"=>$row["first_name"],
                                    "lastName"=>$row["last_name"],
                                    "position"=>$row["position"],
                                    "headStatus"=>$row["head_status"],
                                    "status"=>$row["status"],
                                    "isAddFeedback"=>isAddFeedback($row["button_status"])
                                );
    }
}

if(!empty($result["candidateList"])){
    $result["status"] = "true";
    unset($result["status_message"]);
}
 
echo json_encode($result);
 
mysqli_close($con);
?>