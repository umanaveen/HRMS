<?php
require '../../connect.php'; 
$candidateid=$_REQUEST['candidateids'];
$certifcatename=$_REQUEST['certifcatename'];
$certifcatenumber=$_REQUEST['certifcatenumber'];
$validityfrom=$_REQUEST['validityfrom'];
$validityto=$_REQUEST['validityto'];
$certifcatefile="doc.doc";
$status=17;
$today = date("Y-m-d H:i:s"); 
 for($i=0;$i<count($certifcatename);$i++)
    {
$cn=$con->query("INSERT INTO emp_certification(emp_id, certification_name, certification_number, validity_from, validity_to, attachment, status, created_by, created_on) VALUES ('$candidateid[$i]','$certifcatename[$i]','$certifcatenumber[$i]','$validityfrom[$i]','$validityto[$i]','$certifcatefile','$status','$candidateid','$today')"); 
	}
	



?>





















































/* $examination_passed=$_REQUEST['examination_passed'];
$instute=$_REQUEST['instute'];
$degree=$_REQUEST['degree'];
$field=$_REQUEST['field'];
$passing=$_REQUEST['passing'];
$percentage=count($_REQUEST['percentage']); 
$attchement="dox.doc";
/* echo $percentagea=$_FILES['attachments']['name']; 
 
 
     for($i=0;$i<$percentage;$i++)
    {
      echo $file_name= $_FILES['attachments']['tmp_name'][$i];
       
       /*  $education_files = $_FILES['file_name']['name'];
        $education_path = '/certificates/'.$education_files;
        if(!empty($education_files)){
            move_uploaded_file($_FILES['$file_name']['tmp_name'], '/certificates/'.$Adhar_filename);	
        }  
    } 
  
$status=17;
$user_id=1;
$today = date("Y-m-d H:i:s"); 
 for($i=0;$i<$percentage;$i++)
    {
$s=$con->query("INSERT INTO emp_qualification(emp_id, education, institution_name, degree, field_of_specialization, year_of_passing, percentage, attachment, status, created_on, created_by) VALUES ('$candidateid[$i]','$examination_passed[$i]','$instute[$i]','$degree[$i]','$field[$i]','$passing[$i]','$percentage[$i]','$attchement','$status','$today','$candidateid')");
echo "INSERT INTO emp_qualification(emp_id, education, institution_name, degree, field_of_specialization, year_of_passing, percentage, attachment, status, created_on, created_by) VALUES ('$candidateid[$i]','$examination_passed[$i]','$instute[$i]','$degree[$i]','$field[$i]','$passing[$i]','$percentage[$i]','$attchement','$status','$today','$candidateid')";
} */
?>