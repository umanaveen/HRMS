<?php
require '../../connect.php';
$ids=$_REQUEST['ids'];
$title=$_REQUEST['title'];
$gender=$_REQUEST['gender'];
$first_name=$_REQUEST['first_name'];
$last_name=$_REQUEST['last_name'];
$user_name=$_REQUEST['user_name'];
$mail=$_REQUEST['mail'];
$phone=$_REQUEST['phone'];
$dob=date('Y-m-d',strtotime($_REQUEST['dob']));
$doj=date('Y-m-d',strtotime($_REQUEST['doj']));
$department=$_REQUEST['department'];
$designation=$_REQUEST['designation'];
$country=$_REQUEST['country'];
$region=$_REQUEST['region'];
$city=$_REQUEST['city'];
$address=$_REQUEST['address'];
$id_type=$_REQUEST['id_type'];
$id_number=$_REQUEST['id_number'];
$leave_type=$_REQUEST['leave_type'];
$remark=$_REQUEST['remark'];
$salary=$_REQUEST['salary'];
$now=date('Y-m-d');
$status=$_REQUEST['status'];
$statement = $con->prepare('update masters_employee set emp_no=:title, gender=:gender, first_name=:first_name, last_name=:last_name, user_name=:user_name, email=:email,  DOB=:DOB, phone=:phone, department=:department, designation=:designation, country=:country, region=:region, city=:city, address=:address, id_type=:id_type, id_number=:id_number, remark=:remark, doj=:doj, salary=:salary, leave_type=:leave_type, status=:status where id=:id');
$statement->execute([
    'title' => $title,
    'gender' => $gender,
    'first_name' => $first_name,
    'last_name' => $last_name,
    'user_name' => $user_name,
    'email' => $mail,
    'DOB' => $dob,
    'phone' => $phone,
    'department' => $department,
    'designation' => $designation,
    'country' => $country,
    'region' => $region,
    'city' => $city,
    'address' => $address,
    'id_type' => $id_type,
    'id_number' => $id_number,
    'remark' => $remark,
    'doj' => $doj,
    'salary' => $salary,
    'leave_type' => $leave_type,
    'status' => $status,
    'id' => $ids,
]); 
if($statement)
{
	echo 0;
}
else
{
	echo 1;
} 
?>