<?php
include("../config.php");

$db = new DB_Connect();
$con = $db->connect();

$token = $_POST["token"];
$enquiryId = $_POST["enquiryId"];

function getClientType($clientType){
    if($clientType == 1){
        return "Existing";
    }else {
        return "New";
    }
}

$result["status"] = "false";
$result["status_message"] = "Token Invalid";

if($db->validateToken($con, $token)){
    $sql_query = "SELECT (SELECT name 
                            FROM `calls_master`
                            WHERE id = e.Call_type) AS call_type,
                        e.date,
                        e.Client_type,
                        e.Company_name,
                        e.Location,
                        e.Address,
                        e.Client,
                        e.Mobile,
                        e.Designation,
                        e.mail,
                        e.Product,
                        e.Feedback,
                        e.Follup,
                        (SELECT dept_name 
                            FROM `z_department_master` 
                            WHERE `status` = 1 
                            AND id = e.Department) AS department,
                        (SELECT CONCAT(first_name, ' ', last_name) 
                            FROM `candidate_form_details` 
                            WHERE id = e.employee) AS employee

                    FROM `enquiry` AS e
                    WHERE e.id = '$enquiryId'";
    
    $res = mysqli_query($con, $sql_query);

    $result = array("status"=>"false", "status_message"=>"No Entry Found");
    
    while($row = mysqli_fetch_array($res)){
        $result["enquiryDetails"] = array("callType"=>$row["call_type"],
                                    "date"=>$row["date"],
                                    "clientType"=>getClientType($row["Client_type"]),
                                    "companyName"=>$row["Company_name"],
                                    "location"=>$row["Location"],
                                    "address"=>$row["Address"],
                                    "client"=>$row["Client"],
                                    "mobile"=>$row["Mobile"],
                                    "designation"=>$row["Designation"],
                                    "mail"=>$row["mail"],
                                    "product"=>$row["Product"],
                                    "feedback"=>$row["Feedback"],
                                    "followUp"=>$row["Follup"],
                                    "department"=>$row["department"],
                                    "employee"=>$row["employee"]
                                );
    }
}

if(!empty($result["enquiryDetails"])){
    $sql_query = "SELECT * FROM `feedback_enquiry_crm` WHERE enquiry_id = '$enquiryId'";

    $res = mysqli_query($con, $sql_query);

    while($row = mysqli_fetch_array($res)){
        $result["feedbackEntryDetails"][] = array("feedBack"=>$row["Feedback"],
                                                    "feedbackDate"=>$row["feedback_date"]
                                                );
    }

    $result["status"] = "true";
    unset($result["status_message"]);
}
 
echo json_encode($result);
 
mysqli_close($con);
?>