<?php
require '../../connect.php';
require '../../user.php';
$response = array( 
    //'status' => 0, 
    //'message' => 'Form submission failed, please try again.' 
);
$valid = 1; 

if( isset($_POST['emp_id']) || isset($_POST['organization']) || isset($_POST['designation']) || isset($_POST['from']) || isset($_POST['to']) || isset($_POST['yearofexperience']) || isset($_POST['reference1']) || isset($_POST['reference2']) || isset($_POST['ref_organization1']) || isset($_POST['ref_organization2']) || isset($_POST['con_number1']) || isset($_POST['con_number2']) || isset($_POST['ref_designation1']) || isset($_POST['ref_designation2']) || isset($_POST['ref_mail1']) || isset($_POST['ref_mail2'])){ 


$candidateid=$_POST['cid'];
$id=1;
$organization=$_POST['organization'];
$organization_count= count($organization);
$designation=$_POST['designation'];
$from=$_POST['from'];
$to=$_POST['to'];
$yearofexperience=$_POST['yearofexperience'];
$reference1=$_POST['reference1'];
$reference2=$_POST['reference2'];
$ref_organization1=$_POST['ref_organization1'];
$ref_organization2=$_POST['ref_organization2'];
$con_number1=$_POST['con_number1'];
$con_number2=$_POST['con_number2'];
$ref_designation1=$_POST['ref_designation1'];
$ref_designation2=$_POST['ref_designation2'];
$ref_mail1=$_POST['ref_mail1'];
$ref_mail2=$_POST['ref_mail2'];

$status=1;


 for($i=0;$i<$organization_count;$i++)
{

$organizations= $organization[$i];
$desig= $designation[$i];
$vfrom= $from[$i];
$vto= $to[$i];
$yoe= $yearofexperience[$i];


//$today = date("Y-m-d H:i:s"); 


  $sql=$con->query("insert into `emp_exp_detail`(`emp_id`, `organization_name`, `designation`, `from_date`, `to_date`, `total_experience`,`reference1`,`reference2`,`ref_organization1`,`ref_organization2`,`con_number1`,`con_number2`,`ref_designation1`,`ref_designation2`,`ref_mail1`,`ref_mail2`,`created_by`)  values('$candidateid','$organizations','$desig','$vfrom','$vto','$yoe','$reference1','$reference2','$ref_organization1','$ref_organization2','$con_number1','$con_number2','$ref_designation1','$ref_designation2','$ref_mail1','$ref_mail2','$candidateid')"); 
  
$upd=$con->query("update candidate_form_details set status=20 where id='$candidateid'");
/* echo "insert into `emp_detail`(`emp_id`, `organization_name`, `designation`, `from_date`, `to_date`, `total_experience`,`created_by`)  values('$candidateid','$organizations','$desig','$vfrom','$vto','$yoe','$candidateid')";  */

}

  $refer=$con->query("insert into `candidate_reference_details`(`emp_id`,`reference1`,`reference2`,`ref_organization1`,`ref_organization2`,`con_number1`,`con_number2`,`ref_designation1`,`ref_designation2`,`ref_mail1`,`ref_mail2`) values('$candidateid','$reference1','$reference2','$ref_organization1','$ref_organization2','$con_number1','$con_number2','$ref_designation1','$ref_designation2','$ref_mail1','$ref_mail2')"); 
  
  $upd=$con->query("update candidate_form_details set status=20 where id='$candidateid'");
if($upd)
{
	 echo 0;
 }
 }



?>






