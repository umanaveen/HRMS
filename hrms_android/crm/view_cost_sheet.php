<?php
include("../config.php");

$db = new DB_Connect();
$con = $db->connect();

$token = $_POST["token"];
$enquiryId = $_POST["enquiryId"];

$gst = 18;
$enquiryStatus = 0;

$result["status"] = "false";
$result["status_message"] = "Token Invalid";

if($db->validateToken($con, $token)){
    $sql_query = "SELECT q.proposal,
                        q.Client,
                        q.Date,
                        q.Version,
                        (SELECT emp_name 
                            FROM `staff_master` 
                            WHERE id = q.emp_id) AS emp_name,
                        q.email_id,
                        q.tel_no,
                        q.scope,
                        q.Proposal_statement,
                        q.Conditions,
                        (SELECT `status`
                            FROM `enquiry`
                            WHERE id = $enquiryId) AS enquiry_status
                        
                    FROM `quotation` AS q
                    WHERE q.Enquire_id = $enquiryId";
    
    $res = mysqli_query($con, $sql_query);

    $result["status"] = "false";
    $result["status_message"] = "No Entry Found";
    
    while($row = mysqli_fetch_array($res)){
        $result["enquiryDetails"] = array("proposal"=>$row["proposal"],
                                    "client"=>$row["Client"],
                                    "date"=>$row["Date"],
                                    "version"=>$row["Version"],
                                    "empName"=>$row["emp_name"],
                                    "emailId"=>$row["email_id"],
                                    "telephoneNo"=>$row["tel_no"],
                                    "scope"=>$row["scope"],
                                    "proposalStatement"=>$row["Proposal_statement"],
                                    "termsAndConditions"=>$row["Conditions"]
                                );
        $enquiryStatus = $row["enquiry_status"];
    }

    if(!empty($result["enquiryDetails"])){
        $result["gst"] = $gst . "%";

        for($i = 1; $i <= 5; $i++){
            $sql_query = "SELECT *
                            FROM `cost_sheet_entry` AS cse
                            WHERE cse.Phases = $i AND
                            cse.enquiry_id = $enquiryId";

            $res = mysqli_query($con, $sql_query);

            $total = 0;
            $phase = [];
            $phase["name"] = "phase" . $i;
            while($row = mysqli_fetch_array($res)){
                $phase["entries"][] = array("specification"=>$row["Specification"],
                                                "days"=>$row["day"],
                                                "amount"=>$row["Amount"]
                                    );
                $total = $total + (int) $row["Amount"];
            }

            if($total != 0){
                $phase["total"] = $total;
                $phase["grandTotal"] = $total + (($total * 18) / 100);
                $result["phases"][] = $phase;
            }
        
        }

        if($enquiryStatus == 4){
            $result["showButtons"] = "true";
        }else {
            $result["showButtons"] = "false";
        }
    }

}

if(!empty($result["enquiryDetails"])){
    $result["status"] = "true";
    unset($result["status_message"]);
}
 
echo json_encode($result);
 
mysqli_close($con);
?>