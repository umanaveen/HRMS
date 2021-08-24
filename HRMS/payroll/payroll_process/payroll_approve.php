<?php

	require '../../../connect.php';
	
	$month = $_REQUEST['month'];
	$year = $_REQUEST['year'];
	$id = $_REQUEST['id'];

	
	$payroll_update=$con->query("update payroll_master set flag=1 where month='$month' and year='$year' and flag=2");
	
	$salary_earnings_delete=$con->query("DELETE FROM payroll_salary_earnings WHERE payroll_month='$month' and payroll_year='$year'");
	
	$salary_deduction_delete=$con->query("DELETE FROM payroll_salary_deduction WHERE payroll_month='$month' and payroll_year='$year'");
	
	if($payroll_update && $salary_earnings_delete && $salary_deduction_delete)
	{
		echo 1;
	}
	
	