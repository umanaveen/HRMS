<?php 
/* require ("../configuration_CLMS_V.php");

		echo $month=$_REQUEST['month'];
		echo $year=$_REQUEST['year'];
		echo $date = date('Y-m-d');

		$attendance_day_cal = sqlsrv_query($conn,"select count(IDCARDNO) as no_of_dys,EMPCODE,IDCARDNO,Employee_Name,CNAME from Employee_Daily_Attendance where Shift_date > '2021-02-01' group by EMPCODE,IDCARDNO,Employee_Name,CNAME order by CNAME");
 

	$cnt=1;
	while($emp_day_count_res=sqlsrv_fetch_array($attendance_day_cal, SQLSRV_FETCH_ASSOC))
	{
		$pf_amount=0;
		
		$IDCARDNO=$emp_day_count_res['IDCARDNO'];				
		$days=$emp_day_count_res['no_of_dys'];
		$CNAME=$emp_day_count_res['CNAME'];		
		
		$query="select distinct ECODE,CCODE,NEW_CODE,PRE_CODE,ENAME,WORK_ORDER_No,case when WAGE is Null then 0 else WAGE end as pd_wage, case when ALLOWANCE is Null then 0 else ALLOWANCE end as pd_allowance, case when INCENTIVE is Null then 0 else INCENTIVE end as pd_incentive from cpcl_employee_master where ECODE ='$IDCARDNO'";

	
		$con_query=sqlsrv_query($conn,$query);
		$emp_res=sqlsrv_fetch_array($con_query, SQLSRV_FETCH_ASSOC);

		$emp_res['ENAME'];
		$CCODE=$emp_res['CCODE'];
		$EMPCODE=$emp_res['ECODE'];
		$PREVIOUSCODE=$emp_res['PRE_CODE'];	
		$EMPNAME=$emp_res['ENAME'];	
		$PO_No=$emp_res['WORK_ORDER_No'];				
		$pdwage=$emp_res['pd_wage'];
		$pdallow=$emp_res['pd_allowance'];
		$pdincen=$emp_res['pd_incentive'];	 
		
		$basic=($days*$pdwage);
		$other_allowance=($days*$pdallow);
		$incentive=($days*$pdincen);
		
		$pt_deduction="select * from PTDeduction where E_No='$PREVIOUSCODE'";
		//echo "select * from PTDeduction where E_No='$PREVIOUSCODE'";
		$PT_DEDUCTION_query=sqlsrv_query($conn,$pt_deduction);
		$pt_deduction_data=sqlsrv_fetch_array($PT_DEDUCTION_query, SQLSRV_FETCH_ASSOC);

		$Nov=$pt_deduction_data['Nov'];
		$Oct=$pt_deduction_data['Oct'];
		$Sep=$pt_deduction_data['Sep'];
		$Aug=$pt_deduction_data['Aug'];
		$Dec=$pt_deduction_data['Dec'];
      
			$pt_dedction_total=($Nov+$Oct+$Sep+$Aug+$Dec);
			
			$total_earnings = $basic+$other_allowance+$incentive;
			
			if($basic<15000)
			{
				$pf_amount=round(($basic*12)/100);
			}
			else if($basic>15000)
			{
				$pf_amount=round((15000*12)/100);
			}
			
			if($total_earnings<21000){
				$esi_amount=ceil(($basic*0.75)/100);
			}
			else if($total_earnings>21000)
			{
				$esi_amount=0;
			}
			
			//$lwf = 10;
			
			$total_deduction=$pf_amount+$esi_amount;
			
			
			$gross = $basic+$other_allowance+$incentive;
			
			$pt_dedction_slab = $pt_dedction_total+$gross;
			
			if($pt_dedction_slab<=21000)
			{
				$pt_deduction_result =0;
			}
			else if($pt_dedction_slab>21000 && $pt_dedction_slab<30000)
			{
				$pt_deduction_result =135;
			}
			else if($pt_dedction_slab>31001 && $pt_dedction_slab<45000)
			{
				$pt_deduction_result =315;
			}
			else if($pt_dedction_slab>45001 && $pt_dedction_slab<60000)
			{
				$pt_deduction_result =690;
			}
			else if($pt_dedction_slab>60001 && $pt_dedction_slab<75000)
			{
				$pt_deduction_result =1025;
			}
			else if($pt_dedction_slab>75001)
			{
				$pt_deduction_result =1250;
			}
			
			
			
			$payroll_advance_deduction="select * from payroll_salary_deduction where id_card_no='$EMPCODE'";
			$payroll_advance_deduction_query=sqlsrv_query($conn,$payroll_advance_deduction);
			$payroll_advance_deduction_query_execute=sqlsrv_fetch_array($payroll_advance_deduction_query, SQLSRV_FETCH_ASSOC);
			
			$advance_amount=$payroll_advance_deduction_query_execute['advance_amount'];
			
			$net_pay = $gross-$total_deduction;
			
			$insert=sqlsrv_query($conn,"INSERT INTO payroll_employee_salary_master (payroll_month,payroll_year,date,con_code,con_name
           ,emp_old_code,emp_new_code,emp_name,no_of_days,no_of_holidays,pd_wages,pd_allow,pd_incen,
		   pf_amount,esi_amount,salary_advance,ptf_amount,gross_salary,net_pay,flag,created_by,created_on) VALUES
           ('$month','$year','$date','$CCODE','$CNAME','$PREVIOUSCODE','$EMPCODE','$EMPNAME',
		   '$days','0','$pdwage','$pdallow','$pdincen','$pf_amount',$esi_amount,'$advance_amount',0,$gross,$net_pay,'1','1','$date')"); 
 
			 if($insert)
			 {			 
				echo "success";
			 }
		}
 */
		
?>			


	