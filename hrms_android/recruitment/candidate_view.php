<?php
include("../config.php");

$db = new DB_Connect();
$con = $db->connect();

$token = $_POST["token"];
$candidateId = $_POST["candidateId"];
$candidateStatus = 0;

$result = array("status"=>"false", "status_message"=>"Token Invalid");

if($db->validateToken($con, $token)){

    // Candidate Details
    $sql_query = "SELECT cfd.status,
                        dm.designation_name,
                        zdm.dept_name,
                        cfd.first_name,
                        cfd.last_name,
                        cfd.gender,
                        cfd.father_name,
                        cfd.dob,
                        cfd.address,
                        cfd.paddress,
                        cfd.phone,
                        cfd.alternative_phone,
                        cfd.mail,
                        cfd.adharnumber,
                        cfd.pannumber,
                        cfd.voternumber,
                        cfd.educationalDetails,
                        cfd.EmployeeStatus,
                        cfd.year_of_pass

                    FROM `candidate_form_details` AS cfd 
                    LEFT JOIN `company_master` AS cm ON cm.id = cfd.company_name 
                    JOIN `designation_master` AS dm ON dm.id = cfd.position 
                    JOIN `z_department_master` AS zdm ON zdm.id = cfd.department
                    WHERE cfd.id = $candidateId 
                    ORDER BY cfd.id DESC LIMIT 1";
    
    $res = mysqli_query($con, $sql_query);

    $result = array("status"=>"false", "status_message"=>"No Entry Found");
    
    while($row = mysqli_fetch_array($res)){
        $result["candidateDetails"] = array("candidateStatus"=>$row["status"],
                                            "designationName"=>$row["designation_name"],
                                            "deptName"=>$row["dept_name"],
                                            "firstName"=>$row["first_name"],
                                            "lastName"=>$row["last_name"],
                                            "gender"=>$row["gender"],
                                            "fatherName"=>$row["father_name"],
                                            "dob"=>$row["dob"],
                                            "address"=>$row["address"],
                                            "permanentAddress"=>$row["paddress"],
                                            "phone"=>$row["phone"],
                                            "alternativePhone"=>$row["alternative_phone"],
                                            "email"=>$row["mail"],
                                            "aadharNo"=>$row["adharnumber"],
                                            "panNo"=>$row["pannumber"],
                                            "voterNo"=>$row["voternumber"],
                                            "educationalDetails"=>$row["educationalDetails"],
                                            "employeeStatus"=>$row["EmployeeStatus"],
                                            "yearOfPass"=>$row["year_of_pass"]
                                        );

        $candidateStatus = $row["status"];
    }


    // Aplitude Marks
    $result["feedBacks"]["aplitudeStatus"] = "false";
    $result["feedBacks"]["aplitude"] = new stdClass();

    $sql_query = "SELECT COUNT(*) AS total 
                    FROM `candicate_results` AS cr 
                    JOIN `question_master` AS qm ON qm.id = cr.question
                    WHERE cr.ueser_id = " . $candidateId . " AND cr.answer = qm.answer_key";

    $res = mysqli_query($con, $sql_query);

    while($row = mysqli_fetch_array($res)){
        if($row["total"] > 0){
            $result["feedBacks"]["aplitudeStatus"] = "true";
            $result["feedBacks"]["aplitude"] = [];
            $result["feedBacks"]["aplitude"]["totalMarks"] = $row["total"];
        }
    }


    // Technical Department
    $result["feedBacks"]["technicalStatus"] = "false";
    $result["feedBacks"]["technical"] = new stdClass();

    if($candidateStatus == 3 || $candidateStatus >= 5){
        $sql_query = "SELECT sm.emp_name AS interviewer,
                            ir.name AS dept_name

                        FROM `candidate_round_details` AS crd 
                        JOIN `staff_master` AS sm ON sm.id = crd.person_id 
                        JOIN `interview_rounds` AS ir ON ir.id = crd.round_id
                        WHERE crd.candid_id = " . $candidateId . " AND crd.status = 5";

        $res = mysqli_query($con, $sql_query);

        while($row = mysqli_fetch_array($res)){
            $result["feedBacks"]["technicalStatus"] = "true";
            $result["feedBacks"]["technical"] = [];
            $result["feedBacks"]["technical"]["technicalName"] = $row["interviewer"];
            $result["feedBacks"]["technical"]["departmentName"] = $row["dept_name"];
        }

        $sql_query = "SELECT irn.Sec_name, 
                            de.feedback

                        FROM `candidate_round_details` AS crd 
                        JOIN `domain_entries` AS de ON de.candids_id = crd.candid_id
                        JOIN `interview_round_name` AS irn ON irn.id = de.round_name_id 
                        WHERE crd.candid_id = " . $candidateId . " 
                        AND de.hire_id = crd.person_id
                        AND crd.status = 5";

        $res = mysqli_query($con, $sql_query);

        while($row = mysqli_fetch_array($res)){
            $result["feedBacks"]["technical"]["technicalFeedback"][] = array("sectionName"=>$row["Sec_name"],
                                                        "feedBack"=>$row["feedback"]
                                                    );
        }
    }


    // HOD Department
    $result["feedBacks"]["hodStatus"] = "false";
    $result["feedBacks"]["hod"] = new stdClass();

    if($candidateStatus == 3 || $candidateStatus >= 13){
        $sql_query = "SELECT sm.emp_name AS interviewer
                        FROM `candidate_round_details` AS crd 
                        JOIN `staff_master` AS sm ON sm.id = crd.person_id 
                        WHERE crd.candid_id = " . $candidateId . " AND crd.status = 13";

        $res = mysqli_query($con, $sql_query);

        while($row = mysqli_fetch_array($res)){
            $result["feedBacks"]["hodStatus"] = "true";
            $result["feedBacks"]["hod"] = [];
            $result["feedBacks"]["hod"]["hodName"] = $row["interviewer"];
        }

        $sql_query = "SELECT irn.Sec_name, 
                            deh.feedback

                        FROM `candidate_round_details` AS crd 
                        JOIN `domain_entries_hod` AS deh ON deh.candids_id = crd.candid_id
                        JOIN `interview_round_name` AS irn ON irn.id = deh.round_name_id 
                        WHERE crd.candid_id = " . $candidateId . " 
                        AND deh.hire_id = crd.person_id
                        AND crd.status = 13";
                        

        $res = mysqli_query($con, $sql_query);

        while($row = mysqli_fetch_array($res)){
            
            $result["feedBacks"]["hod"]["hodFeedback"][] = array("sectionName"=>$row["Sec_name"],
                                                        "feedBack"=>$row["feedback"]
                                                    );
        }
    }


    // MD Department
    $result["feedBacks"]["mdStatus"] = "false";
    $result["feedBacks"]["md"] = new stdClass();

    if($candidateStatus == 3 || $candidateStatus >= 16){
        $sql_query = "SELECT sm.emp_name AS interviewer
                        FROM `candidate_round_details` AS crd 
                        JOIN `staff_master` AS sm ON sm.id = crd.person_id 
                        WHERE crd.candid_id = " . $candidateId . " AND crd.status = 16";

        $res = mysqli_query($con, $sql_query);

        while($row = mysqli_fetch_array($res)){
            $result["feedBacks"]["mdStatus"] = "true";
            $result["feedBacks"]["md"] = [];
            $result["feedBacks"]["md"]["mdName"] = $row["interviewer"];
        }

        $sql_query = "SELECT irn.Sec_name, 
                            dem.feedback

                        FROM `candidate_round_details` AS crd 
                        JOIN `domain_entries_md` AS dem ON dem.candids_id = crd.candid_id
                        JOIN `interview_round_name` AS irn ON irn.id = dem.round_name_id 
                        WHERE crd.candid_id = " . $candidateId . " 
                        AND dem.hire_id = crd.person_id
                        AND crd.status = 16";

        $res = mysqli_query($con, $sql_query);

        while($row = mysqli_fetch_array($res)){
            $result["feedBacks"]["md"]["mdFeedback"][] = array("sectionName"=>$row["Sec_name"],
                                                        "feedBack"=>$row["feedback"]
                                                    );
        }
    }

}

if(!empty($result["candidateDetails"])){
    $result["status"] = "true";
    unset($result["status_message"]);
}else {
    unset($result["feedBacks"]);
}
 
echo json_encode($result);
 
mysqli_close($con);
?>