<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

	include_once '../connect.php';
	include_once './master_class.php';
	
	$database = new Database();
	$db = $database->getConnection();
	
	//instantiate leave_master_table 
	$leave_opn_table = new employee_leave_apply($db);	
	
	
	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);
	
	$staff_id = $_POST['StaffId'];
	
	$leave_opn_table->staff_id = $staff_id;
	
	$stmt = $leave_opn_table->getUserleave();
	$num = $stmt->rowCount();
	
	if($num > 0)
	{
		$leave_bal_array = array();
		$leave_bal_array["leavetype"]=array();
		
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);			
			$leave_bal_two = array(
			"id"=>$id,"leave_type_id"=>$leave_type_id,"staff_id"=>$staff_id,"available_leave"=>$available_leave);			
			array_push($leave_bal_array["leavetype"], $leave_bal_two);
			
		}
				
		// set response code - 200 OK
		http_response_code(200);	  
		// show products data in json format
		echo json_encode($leave_bal_array);
	}