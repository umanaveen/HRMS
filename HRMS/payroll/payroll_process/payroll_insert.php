<?php
require '../../../connect.php';

		$month = $_REQUEST['month'];
		$year = $_REQUEST['year'];
		$date = date('Y-m-d');
	
		//payroll update
		
		$payroll_update=$con->query("update payroll_master set flag=2 where month='$month' and year='$year' and flag=1");
		
		if($payroll_update)
		{
			echo 1;
			//payroll for Onroll EmployeeCode

			$in_log_date='2021-07-01';
			$out_log_date='2021-07-31';

			$dateMonthYearArr = array();
			$in_log_dateTS = strtotime($in_log_date);
			$out_log_dateTS = strtotime($out_log_date);
			
			for ($currentDateTS = $in_log_dateTS; $currentDateTS <= $out_log_dateTS; $currentDateTS += (60 * 60 * 24)) 
			{
				$currentDateStr = date("Y-m-d",$currentDateTS);
				$dateMonthYearArr[] = $currentDateStr;
			}
		
			//Holiday start here 
			
			$datequery=$con->query("select leave_date from holiday_master where year=year('$in_log_date')");
			while($result_query = $datequery->fetch(PDO::FETCH_ASSOC))	
			{
				$GOV_HOLIDAY[]=$result_query['leave_date'];
			}	

				//print_r($GOV_HOLIDAY);
				
		
			//employee start loop here  
			
			
			$inndate1=$con->query("SELECT emp_code as emp_no FROM staff_master WHERE status=1 and prefix_code not in ('BC') and emp_code='00012'");	
			
			while($att_result_query=$inndate1->fetch(PDO::FETCH_ASSOC))
			{
				$emp_no=$att_result_query['emp_no'];			
				$day_count=0;
				$sundays = 0;
				$saturday_count=0;
				
					for($i=0;$i<sizeof($dateMonthYearArr);$i++)
					{
						$date=$dateMonthYearArr[$i];
						$day=date('D',strtotime($date));
						$xx=count($dateMonthYearArr);

						$dayquery=$con->query("SELECT COUNT(*) FROM bb_attendance_view WHERE emp_no='$emp_no' and in_log_date='$date'");
						
						$count = $dayquery->fetchColumn();
						
						if($count>0)
						{
							$day_count=$day_count+1;
						}
						else
						{
							$dayquery=$con->query("SELECT count(*) FROM manual_att where date='$date' and emp_code='$emp_no'");						
							$count = $dayquery->fetchColumn();
							if($count>0)
							{
								$day_count=$day_count+1;
							}
						}
						if(($day=="Sun")||(in_array($date, $GOV_HOLIDAY)))	
						{
							$sundays =$sundays +1;
						}
						
						if($day=="Sat")
						{
							$saturday_count=$saturday_count+1;
							if($saturday_count%2 == 0)
							{
								$day_count=$day_count+1;
							}
						}
					}
					
				$total_working_days = $day_count+$sundays;					
				$lop = sizeof($dateMonthYearArr) - $total_working_days;
								
				$staff_data_sql=$con->query("SELECT  id,emp_code as emp_no, emp_name,dep_id as department_id,design_id as designation_id, scale_master_id, payroll_deduction_id,salary_amount,status FROM staff_master where status=1 and emp_code='$emp_no'");	

				while($sm_data = $staff_data_sql->fetch(PDO::FETCH_ASSOC))
				{					
					$emp_code = $sm_data['emp_no'];
					$emp_name = $sm_data['emp_name'];
					$scale_id = $sm_data['scale_master_id'];
					$salary_amount = $sm_data['salary_amount'];
					$deduct_id = $sm_data['payroll_deduction_id'];

					$scale_head_sql = $con->query("SELECT a.payroll_master_id, a.payroll_master_name, a.salary_structure_id, a.salary_structure_name,b.amount,b.percentage,a.status FROM payroll_scale_details a join  payroll_structure b on a.salary_structure_id=b.id where a.payroll_master_id='$scale_id'");
					
					//earnings Part
					while($scale_head_data = $scale_head_sql->fetch(PDO::FETCH_ASSOC))
					{
						$salary_structure_id=$scale_head_data['salary_structure_id'];
						$earnings=$scale_head_data['salary_structure_name'];
						$struct_amount=$scale_head_data['amount'];

						if($struct_amount==0)
						{
							$percentage=$scale_head_data['percentage'];
							$amount = ($salary_amount*$percentage/100);
						}
						else
						{
							$amount = $struct_amount;
						}
				
							$data = array($date,$month,$year,$emp_code,$emp_name,$earnings,$amount,1,1,$date); 

							$stmt = $con->prepare("INSERT INTO payroll_salary_earnings(date, payroll_month, payroll_year, employee_code, employee_name, earnings, amount, status, created_by, created_on) VALUES (?,?,?,?,?,?,?,?,?,?)");

							$stmt->execute($data);

							if($stmt)
							{
								//echo "success";
							}		
					}
					
					//deductions part
					
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

						try
						{

							$data = array($date,$month,$year,$emp_code,$emp_name,$deduction,$amount,1,1,$date); 

							$stmt = $con->prepare("INSERT INTO payroll_salary_deduction(date, payroll_month, payroll_year, employee_code, employee_name, deduction, amount, status, created_by, created_on) VALUES (?,?,?,?,?,?,?,?,?,?)");
							$stmt->execute($data);

						}
						catch(Exception $e)
						{
							//echo "Failed: " . $e->getMessage();
						}
					}
					
					if($lop>0)
					{
							$perday_amount = ($salary_amount/30);
							$total_lop = ($perday_amount*$lop);
							
							$data = array($date,$month,$year,$emp_code,$emp_name,'Loss Of Pay',$total_lop,1,1,$date); 

							$stmt = $con->prepare("INSERT INTO payroll_salary_deduction(date, payroll_month, payroll_year, employee_code, employee_name, deduction, amount, status, created_by, created_on) VALUES (?,?,?,?,?,?,?,?,?,?)");
							$stmt->execute($data);
					} 
				}
			}
		}
		
//payroll for Onroll EmployeeCode close here 		