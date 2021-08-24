<?php
require '../../connect.php';
	
	$title=$_REQUEST['title']; // emp id 
$gender=$_REQUEST['gender'];
$first_name=$_REQUEST['first_name'];
$last_name=$_REQUEST['last_name'];
$user_name=$_REQUEST['user_name'];
$password=md5($_REQUEST['email']);
$mail=$_REQUEST['password'];
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
$status=1;

	$room_entry_type=$con->prepare("INSERT INTO employee_user(emp_id, gender, first_name, last_name, user_name, email, password, phone, dob, doj, department, designation, country, region, city, address, id_type, id_number,  leave_type, remark, salary, status)VALUES (:title, :gender, :first_name, :last_name, :user_name, :email, :password, :phone, :dob, :doj, :department, :designation, :country, :region, :city, :address, :id_type, :id_number, :leave_type, :remark, :salary, :status)) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k,:l,:m,:n,:o,:p,:q,:r,:s,:t,:u,:v)");
	
//echo "INSERT INTO masters_floor(name, floor_number, description, status) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k,:l,:m,:n,:o,:p,:q,:r,:s,:t,:u,:v)";

	$room_entry_type->bindvalue(':a',$emp_no);
	$room_entry_type->bindvalue(':b',$gender);
	$room_entry_type->bindvalue(':c',$first_name);
	$room_entry_type->bindvalue(':d',$last_name);
	$room_entry_type->bindvalue(':e',$user_name);
	$room_entry_type->bindvalue(':f',$email);
	$room_entry_type->bindvalue(':g',$password);
	$room_entry_type->bindvalue(':h',$phone);
	$room_entry_type->bindvalue(':i',$dob);
	$room_entry_type->bindvalue(':j',$doj);
	$room_entry_type->bindvalue(':k',$department);
	$room_entry_type->bindvalue(':l',$designation);
	$room_entry_type->bindvalue(':m',$country);
	$room_entry_type->bindvalue(':n',$region);
	$room_entry_type->bindvalue(':o',$city);
	$room_entry_type->bindvalue(':p',$address);
	$room_entry_type->bindvalue(':q',$id_type);
	$room_entry_type->bindvalue(':r',$id_number);
	$room_entry_type->bindvalue(':s',$leave_type);
	$room_entry_type->bindvalue(':t',$remark);
	$room_entry_type->bindvalue(':u',$salary);
	$room_entry_type->bindvalue(':v',$status);
	
	//$room_entry_type->bindvalue(':e',$status);

	if($room_entry_type->execute())
	{
		echo "success";
	}
	else
	{
		echo "not";
	}
?>