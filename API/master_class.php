<?php

class employee_leave_apply
{
	private $conn;	
	public $staff_id;	
	public $leave_type_id;
	public $from_date;
	public $to_date;
	public $taken_days;
	public $status;
	public $created_by;
	
	public function __construct($db)
	{
		$this->conn = $db;
	}
	
	function getUserleave()
	{
		$query = "SELECT id,leave_type_id, staff_id,available_leave FROM leave_tracker where staff_id =".$this->staff_id." and status=1";
		
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
	
	function staff_leave_creation()
	{
		$sql = "CALL  staff_leave_master_crud ('$this->staff_id','$this->leave_type_id','$this->from_date','$this->to_date','$this->taken_days','$this->status')";
		$stmt = $this->conn->prepare($sql);
		if(!$stmt->execute())
		{
			print_r($stmt->errorInfo());
			return false;
		}
		else
		{
			return true;
		}
	}
}