<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

	include_once '../../connect.php';
	include_once './leave_master_class.php';
	
	
	// instantiate database 
	$database = new Database();
	$db = $database->getConnection();

	//instantiate leave_master_table 
	$leave_opn_table = new leave_master($db); 
	$stmt = $leave_opn_table->leave_opening_view();
	$num = $stmt->rowCount();

	if($num>0)
	{
		$leave_opn_array = array();
		$leave_opn_array["records"]=array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);
							
			$leave_mapp_values = array(
			"staff_id"=>$staff_id,
			"emp_code"=>$emp_code,
			"emp_name"=>$emp_name,
			"staff_type_id"=>$staff_type_id,
			"doj"=>$doj,
			"from_date"=>$from_date,
			"Casual_Leave"=>$Casual_Leave,
			"Sick_Leave"=>$Sick_Leave,
			"Privilege_Leave"=>$Privilege_Leave
			);
			
			array_push($leave_opn_array["records"],$leave_mapp_values);
		}
				
		// set response code - 200 OK
		http_response_code(200);
	  
		// show products data in json format
		echo json_encode($leave_opn_array);
	}
