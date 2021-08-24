<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../connect.php';
include_once './master_class.php';

$database = new Database();
$db = $database->getConnection();

$leave_create_table = new employee_leave_apply($db);

	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);

	//set leave_create_table property values
    $leave_create_table->staff_id = $request->StaffId;
	$leave_create_table->leave_type_id = $request->leave_type_id;
    $leave_create_table->from_date = $request->from_date;
    $leave_create_table->to_date = $request->to_date;
    $leave_create_table->taken_days = $request->taken_days;
    $leave_create_table->status = $request->status;
    $leave_create_table->created_by = 1;
  
    // create the staff_leave_creation
	
    if($leave_create_table->staff_leave_creation())
	{
        // set response code - 201 created
        http_response_code(201);
        // tell the user
        echo json_encode(array("message" => "Product was created."));
    }
    // if unable to create the leave_create_table, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
        // tell the user
        echo json_encode(array("message" => "Unable to create product."));
    } 
