<?php
require '../../connect.php';
include("../../user.php");
$Company_name = $_REQUEST["Company_name"];

$sql=$con->query("SELECT client_master.area,client_master.address1,client_master.client_name,client_master.designation,client_master.mobile_no1,client_master.email_id1,client_master.department_id,client_master.employee_id,z_department_master.dept_name,candidate_form_details.first_name
FROM client_master 
INNER JOIN z_department_master ON client_master.department_id=z_department_master.id 
INNER join candidate_form_details ON client_master.employee_id = candidate_form_details.id
where client_master.org_name='$Company_name'");
//echo "SELECT area,address1,client_name,designation,mobile_no1,email_id1 FROM client_master where org_name='$Company_name'";

  $row = $sql->fetch(PDO::FETCH_ASSOC);

 $area=$row['area'];
$address1=$row['address1'];
$client_name=$row['client_name'];
$designation=$row['designation'];
$mobile_no1=$row['mobile_no1'];
$email_id1=$row['email_id1'];
$department_id=$row['dept_name'];
$employee_id=$row['first_name'];
$department_id1=$row['department_id'];
$employee_id1=$row['employee_id'];
echo $area."=".$address1."=".$client_name."=".$designation."=".$mobile_no1."=".$email_id1."=".$department_id."=".$employee_id."=".$department_id1."=".$employee_id1;
?>