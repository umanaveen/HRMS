<?php
include("../config.php");

$db = new DB_Connect();
$con = $db->connect();

$token = $_POST["token"];
$intervieweeCandidateId = $_POST["intervieweeCandidateId"];
$interviewerCandidateId = $_POST["interviewerCandidateId"];
$rounds = $_POST["rounds"];
$isSelected = $_POST["isSelected"];

$result = array("status"=>"false", "status_message"=>"Token Invalid");

// Get the Interviewer Status as Selected or Rejected
function getInterviewerStatus(){
    global $con;
    global $isSelected;
    global $interviewerCandidateId;
    global $result;
    
    $status_message = "";

    if($isSelected == "true"){
        $status_message = "Selected";
    }else {
        $status_message = "Rejected";
    }

    $sql_query = "SELECT asm.status_id
                    FROM `z_user_master` AS zum
                    JOIN `android_status_master` AS asm ON asm.role_code = zum.user_group_code
                    WHERE zum.candidate_id = " . $interviewerCandidateId . " 
                    AND asm.status_message = '" . $status_message . "'
                    AND asm.category = 1";

    $res = mysqli_query($con, $sql_query);

    $result = array("status"=>"false", "status_message"=>"Status Error");

    while($row = mysqli_fetch_array($res)){
        return $row["status_id"];
    }

    return 0;
}

// Get the Round Id from the Interviewer Rounds Table
function getRoundId(){
    global $con;
    global $interviewerCandidateId;
    global $result;

    $sql_query = "SELECT round_id
                    FROM `interview_rounds_mapping` irm
                    JOIN `staff_master` AS asm ON asm.id = irm.person_name
                    WHERE asm.candid_id = " . $interviewerCandidateId;

    $res = mysqli_query($con, $sql_query);

    $result = array("status"=>"false", "status_message"=>"Round Id not Assigned");

    while($row = mysqli_fetch_array($res)){
        return $row["round_id"];
    }

    return 0;
}

// Get the Hire Id (Person Id) from Staff Master for Interviewer
function getHireId(){
    global $con;
    global $interviewerCandidateId;

    $sql_query = "SELECT id
                    FROM `staff_master` 
                    WHERE candid_id = " . $interviewerCandidateId;

    $res = mysqli_query($con, $sql_query);

    while($row = mysqli_fetch_array($res)){
        return $row["id"];
    }

    return 0;
}

if($db->validateToken($con, $token)){

    $status = getInterviewerStatus();

    if($status != 0) {
        
        $roundId = getRoundId();

        if($roundId != 0){

            $hireId = getHireId();

            $round = json_decode($rounds, TRUE);

            $isEntrySuccessful = FALSE;

            foreach($round as $roundNameId => $roundNameValue) {
                $sql_query = "INSERT INTO `domain_entries` 
                                (`candids_id`, `hire_id`, `round_id`, `round_name_id`, `feedback`)
                                VALUES (".$intervieweeCandidateId.", ".$hireId.", ".$roundId.", ".$roundNameId.", '" . $roundNameValue . "')";

                $con->query($sql_query);

                if(mysqli_affected_rows($con) > 0){
                    $isEntrySuccessful = TRUE;
                }else {
                    $isEntrySuccessful = FALSE;
                    $result = array("status"=>"false", "status_message"=>"Entry Error");
                    break;
                }
            }

            if($isEntrySuccessful === TRUE) {
                $sql_query = "UPDATE `candidate_round_details` 
                                SET `status` = " . $status . ",
                                `modified_by` = " . $interviewerCandidateId . ",
                                `modified_on` = now()
                                WHERE `candid_id` = " . $intervieweeCandidateId . " 
                                AND `person_id` = (SELECT id 
                                                    FROM `staff_master` 
                                                    WHERE `candid_id` = " . $interviewerCandidateId . ")";

                $con->query($sql_query);

                $sql_query = "UPDATE `candidate_form_details` 
                                SET `status` = " . $status . "
                                WHERE `id` = " . $intervieweeCandidateId;

                $con->query($sql_query);

                $result["status"] = "true";
                unset($result["status_message"]);
            }
        }

    }
}

echo json_encode($result);
 
mysqli_close($con);
?>