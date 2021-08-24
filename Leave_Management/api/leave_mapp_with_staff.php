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
	$leave_mapp_table = new leave_master($db); 
	$stmt = $leave_mapp_table->leave_mapping_with_staff();
	$num = $stmt->rowCount();

	if($num>0)
	{
		
			$leave_map_array = array();
			$leave_map_array["records"]=array();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				extract($row);
				
				$leave_mapp_values = array(
				"id"=>$id,
				"staff_type_id"=>$staff_type_id,
				"staff_type"=>$staff_type,
				"leave_type_id"=>$leave_type_id,
				"leave_type"=>$leave_type,
				"status"=>$status		
				);
				
				array_push($leave_map_array["records"],$leave_mapp_values);
			}
			
			
		// set response code - 200 OK
		http_response_code(200);
	  
		// show products data in json format
		echo json_encode($leave_map_array);
	}
