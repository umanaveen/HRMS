<?php
require '../../../connect.php';

$month = $_REQUEST['month'];
$year = $_REQUEST['year'];
$date = date('Y-m-d');

$staff_master_sql = $con->query("select id, candid_id, emp_code, emp_name, dep_id, div_id, design_id, scale_head, deductions,status from staff_master where status = 1");

while($sm_data = $staff_master_sql->fetch(PDO::FETCH_ASSOC))
{
	$emp_code = $sm_data['emp_code'];
	$emp_name = $sm_data['emp_name'];
	$scale_id = $sm_data['scale_head'];
	
	$scale_head_sql = $con->query("SELECT a.payroll_master_id, a.payroll_master_name, a.salary_structure_id, a.salary_structure_name,b.amount,a.status FROM payroll_scale_details a join  payroll_structure b on a.salary_structure_id=b.id where a.payroll_master_id='$scale_id'");
	
	//earnings Part
	while($scale_head_data = $scale_head_sql->fetch(PDO::FETCH_ASSOC))
	{
		$salary_structure_id=$scale_head_data['salary_structure_id'];
		$earnings=$scale_head_data['salary_structure_name'];
		$amount=$scale_head_data['amount'];
		
		try 
		{
			$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$con->beginTransaction();
				

			$data = array($date,$month,$year,$emp_code,$emp_name,$earnings,$amount,1,1,$date); 
				
			$stmt = $con->prepare("INSERT INTO payroll_salary_earnings(date, payroll_month, payroll_year, employee_code, employee_name, earnings, amount, status, created_by, created_on) VALUES (?,?,?,?,?,?,?,?,?,?)");

			$stmt->execute($data);

			$con->commit();
		} 
		catch(Exception $e)
		{
			$con->rollback();
				throw new StorageException("I couldn't save the payroll_salary_earnings");
				echo "Failed: " . $e->getMessage();
		}
	}
	
	
	//deductions part
	$deduct_id = $sm_data['deductions'];
	$deduct_sql = $con->query("SELECT id, name, from_date, amount, percentage, min_amount, max_amount, status FROM payroll_deduction_master where id in ($deduct_id)");
	
	while($deduct_data = $deduct_sql->fetch(PDO::FETCH_ASSOC))
	{
		$id=$deduct_data['id'];
		$deduction=$deduct_data['name'];
		$from_date=$deduct_data['from_date'];
		$amount=$deduct_data['amount'];
		$percentage=$deduct_data['percentage'];
		$min_amount=$deduct_data['min_amount'];
		$max_amount=$deduct_data['max_amount'];
		
		try{
			
			$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$con->beginTransaction();

			$data = array($date,$month,$year,$emp_code,$emp_name,$deduction,$amount,1,1,$date); 
				
			$stmt = $con->prepare("INSERT INTO payroll_salary_deduction(date, payroll_month, payroll_year, employee_code, employee_name, deduction, amount, status, created_by, created_on) VALUES (?,?,?,?,?,?,?,?,?,?)");
			$stmt->execute($data);

			$con->commit();
			
		}
		catch(Exception $e){
			
			$con->rollback();
				throw new StorageException("I couldn't save the payroll_salary_earnings");
				echo "Failed: " . $e->getMessage();
		}
		
		
	}
	
	
	
}