<?php

class leave_master
{
	private $conn;
	private $table_name = "leave_master";
	
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	function read()
	{
						
		$query = "SELECT * FROM leave_master";						
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
	
	function leave_mapping_view()
	{
		$query = "SELECT * FROM leave_master_mapping";
		$stmnt  = $this->conn->prepare($query);
		$stmnt->execute();
		return $stmnt;
		
	}
	
	function leave_mapping_with_staff()
	{
		$query = "SELECT * FROM `leave_mapping_with_staff`";
		$stmnt  = $this->conn->prepare($query);
		$stmnt->execute();
		return $stmnt;
		
	}
	
		function leave_opening_view()
	{

		$query = "SELECT staff_id,b.emp_code,b.emp_name,staff_type_id,doj,from_date,
		MAX(case when leave_type_id = 1 THEN leave_op_balance END) as 'Casual_Leave',
		MAX(case when leave_type_id = 2 THEN leave_op_balance END) as 'Sick_Leave',
		MAX(case when leave_type_id = 3 THEN leave_op_balance END) as 'Privilege_Leave' 
			  FROM leave_opening_balance a join staff_master b on a.staff_id=b.id group by staff_id";

		$stmnt  = $this->conn->prepare($query);
		$stmnt->execute();
		return $stmnt;
	}
	
	function leave_balance_view()
	{
		$query = "SELECT staff_id,c.emp_code,c.emp_name,payroll_month,
		MAX(case when leave_type_id = 1 THEN a.available_leave END) as 'Casual_Leave',
		MAX(case when leave_type_id = 2 THEN a.available_leave END) as 'Sick_Leave',
		MAX(case when leave_type_id = 3 THEN a.available_leave END) as 'Privilege_Leave' 
			  FROM leave_tracker a join leave_master b on a.leave_type_id=b.id join staff_master c on a.staff_id=c.id where payroll_month = 7 group by staff_id";
			  
		$stmnt  = $this->conn->prepare($query);
		$stmnt->execute();
		return $stmnt;
	}
}