<?php
require '../../connect.php';
require '../../user.php';
$response = array( 
    //'status' => 0, 
    //'message' => 'Form submission failed, please try again.' 
);
$valid = 1; 

if( isset($_POST['emp_id']) || isset($_POST['organization']) || isset($_POST['designation']) || isset($_POST['from']) || isset($_POST['to']) || isset($_POST['yearofexperience'])){ 


$candidateid=$_POST['cid'];
$id=1;
$organization=$_POST['organization'];
$organization_count= count($organization);
$designation=$_POST['designation'];
$from=$_POST['from'];
$to=$_POST['to'];
$yearofexperience=$_POST['yearofexperience'];

$status=1;


 for($i=0;$i<$organization_count;$i++)
{

$organizations= $organization[$i];
$desig= $designation[$i];
$vfrom= $from[$i];
$vto= $to[$i];
$yoe= $yearofexperience[$i];


//$today = date("Y-m-d H:i:s"); 


  $sql=$con->query("insert into `emp_exp_detail`(`emp_id`, `organization_name`, `designation`, `from_date`, `to_date`, `total_experience`,`created_by`)  values('$candidateid','$organizations','$desig','$vfrom','$vto','$yoe','$candidateid')"); 
  

/* echo "insert into `emp_detail`(`emp_id`, `organization_name`, `designation`, `from_date`, `to_date`, `total_experience`,`created_by`)  values('$candidateid','$organizations','$desig','$vfrom','$vto','$yoe','$candidateid')";  */

}

if($sql){
	 echo 0;
 }
 }



?>






