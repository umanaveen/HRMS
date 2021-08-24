<?php
	
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	include_once '../../connect.php';
	include_once './leave_master_class.php';

	// instantiate database 
	$database = new Database();
	$db = $database->getConnection();

	//instantiate leave_master_table 
	$leave_master_table = new leave_master($db); 
	$stmt = $leave_master_table->read();
	$num1 = $stmt->rowCount();
	
	if($num1>0)
	{
		$leave_master_array = array();
		$leave_master_array["records"]=array();
		
		// retrieve our table contents
		// fetch() is faster than fetchAll()
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);
			
			$leave_master_values = array(
			"id"=>$id,
			"from_date"=>$from_date,
			"leave_name"=>$leave_name,
			"status"=>$status		
			);
			
			array_push($leave_master_array["records"],$leave_master_values);
			
			//print_r($leave_master_array["records"]);
		}
		
		// set response code - 200 OK
		http_response_code(200);
	  
		// show products data in json format
		echo json_encode($leave_master_array);
	}