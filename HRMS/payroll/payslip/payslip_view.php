<?php
	require '../../../connect.php';
	//payslip_view.php?payroll_id=1&department=0&employee=0
	
	$payroll_id = $_REQUEST['payroll_id'];
	$department = $_REQUEST['department'];
	$employee_id = $_REQUEST['employee'];
	
	//get payroll_master details
		
	$staff_payroll_sql=$con->query("select id,month,year,flag from payroll_master where id = $payroll_id");
	$staff_payroll_res=$staff_payroll_sql->fetch(PDO::FETCH_ASSOC);
	$m=$staff_payroll_res['month'];
	$y=$staff_payroll_res['year'];
	
	if($department != 0  && $employee_id == 0 )
	{
		$staff_sql=$con->query("SELECT * FROM staff_master where dep_id='$department'");		
	}
	else if($department == 0  && $employee_id != 0 )
	{
		//get employee details
		$staff_sql=$con->query("SELECT * FROM staff_master where id = '$employee_id'");
		
	}
	else if($department != 0  && $employee_id != 0 )
	{
		$staff_sql=$con->query("SELECT * FROM staff_master where dep_id='$department' and id = '$employee_id'");
	}
	
		while($staff_sql_res=$staff_sql->fetch(PDO::FETCH_ASSOC))
		{
			$employee_code = $staff_sql_res['emp_code'];
			$emp_name = $staff_sql_res['emp_name'];
			$department_id = $staff_sql_res['dep_id'];
			$designation = $staff_sql_res['design_id'];
		
		
?>

<div id="printableArea">
<table class="table table-bordered table-hover" style="font-family:'Times New Roman', Times, serif;">
		<div class="right" >
		</div>
	
		<caption><center><b>
			Bluebase<br>
			<center>Payslip for the month of  <?php echo $m." - ".$y;?></b></center>
			<center>NAME : <?php echo $employee_code."-".$emp_name;?></b></center>
			<center>DEPARTMENT : <?php echo $department_id;?></b></center>
			<center>DESIGNATION : <?php echo $designation;?></b></center>
			
		</center>
		</caption>

		<table class="table table-bordered table-hover" style="font-family:'Times New Roman', Times, serif;float:left;width:50%;">

		<thead>
			<tr>
				<th>
					SALARY
				</th>
				<th>
					AMOUNT
				</th>
				
			</tr>
		</thead>

		<tbody>
		<?php

		//get staff_earning details

		$staffearnings_sql=$con->query("SELECT id, date, payroll_month, payroll_year, employee_code, employee_name, earnings, amount, status, created_by, created_on, modified_by, modified_on FROM payroll_salary_earnings WHERE employee_code='$employee_code' and payroll_month='$m' and payroll_year='$y' order by id asc");
		
		$gross=0;
		while($staffearnings_res=$staffearnings_sql->fetch(PDO::FETCH_ASSOC))
		{
		?>
			<tr>
			<td><?php echo $staffearnings_res['earnings']; ?></td>
			<td style="text-align:right"><?php echo $staffearnings_res['amount'];;?></td>
			</tr>
		<?php
		
		$gross=$gross+$staffearnings_res['amount'];
		}		
		?>
		
		</tbody>

		</table>
<table class="table table-bordered table-hover" style="font-family:'Times New Roman', Times, serif;float:right;width:50%;">

			
		
		<thead>
			<tr>
			
				<th>
					DEDUCTIONS
				</th>
				<th>
					AMOUNT
				</th>
			</tr>
		</thead>
		<tbody>
		<?php
		 	
		//get staff deductions details
 
		$staffdeduction_sql=$con->query("SELECT id, date, payroll_month, payroll_year, employee_code, employee_name, deduction, amount, status, created_by, created_on, modified_by, modified_on FROM payroll_salary_deduction WHERE employee_code='$employee_code' and payroll_month='$m' and payroll_year='$y' order by id asc");
		
		$total_deductions=0;
		while($staffdeduction_res=$staffdeduction_sql->fetch(PDO::FETCH_ASSOC))
		{
		?>
			<tr>
			<td><?php echo $staffdeduction_res['deduction']; ?></td>
			<td style="text-align:right"><?php echo $staffdeduction_res['amount'];;?></td>
			</tr>
		<?php
		$total_deductions=$total_deductions+$staffdeduction_res['amount'];
		}		
		?>
		
		<tr>


		</tr>

		
		<tr>
		</tbody>
		
	
</table>

</table>
<table class="table table-bordered table-hover" style="font-family:'Times New Roman', Times, serif;float:right;">
		<tr>
		<td>Total Earnings</td>
		<td style="text-align:right"><?php echo $gross;?></td>
		<td>Total Deductions</td>
		<td style="text-align:right"><?php echo $total_deductions;?></td>
		</tr>
		<tr>
		<td></td>
		<td style="text-align:right"></td>
		<td>Net Pay</td>
		<td style="text-align:right"><?php $netpay=$gross-$total_deductions;
		echo $netpay;?></td>
		</tr>
</table>
</div>
<?php

}

?>


