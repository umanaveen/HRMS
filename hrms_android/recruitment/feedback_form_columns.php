<?php
include("../config.php");

$db = new DB_Connect();
$con = $db->connect();

$token = $_POST["token"];
$candidateId = $_POST["candidateId"];

$result = array("status"=>"false", "status_message"=>"Token Invalid");

if($db->validateToken($con, $token)){
    $sql_query = "SELECT id AS `round_name_id`,
                        Sec_name AS `round_name`

                    FROM `interview_round_name`
                    WHERE `inter_id` = (SELECT round_id
                                            FROM `interview_rounds_mapping` irm
                                            JOIN `staff_master` AS sm ON sm.id = irm.person_name
                                            WHERE sm.candid_id = " . $candidateId . ")";
    
    $res = mysqli_query($con, $sql_query);

    $result = array("status"=>"false", "status_message"=>"No Entry Found");
    
    while($row = mysqli_fetch_array($res)){
        $result["results"][] = array("roundNameId"=>$row["round_name_id"],
                                    "roundName"=>$row["round_name"]
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