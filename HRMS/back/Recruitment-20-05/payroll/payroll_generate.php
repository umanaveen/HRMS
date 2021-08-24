<?php 
require '../../connect.php';

$id=$_REQUEST['payroll_master_id'];
$payroll_master=$con->query("select * from payroll_master where flag=2");	

$res = $payroll_master->fetch();
htmlentities($res['id']);
$month=htmlentities($res['month']);
$year=htmlentities($res['year']);

?>		
<div id="payroll_view">		
<div class="box-header with-border">
<div class='box-tools'>
<input type="button" class="btn btn-success" value="Payroll Insert" name="pay_generation" onclick="payroll_insert()">
</div>
<script>
function payroll_insert()
{
	$('#payroll_view').html('<br><div style="text-align: center;"><img src="/CLMS/images/images/pageLoader.gif"></div>');
	var month = <?php echo $month; ?>;
	var year = <?php echo $year; ?>;
	$.ajax({
	type: 'get',
	url: '/Recruitment/Recruitment/Payroll/payroll_insert.php',
	data: 'month='+month+'&year='+year,
	success: function(data)
	{
		$('#payroll_view').html(data);
	}
	});
}
</script>
</div>
<div class="table-responsive mailbox-messages">
<div class="box-body">
<div class="row">
<div class="col-xs-12">				
<div id="printableArea">
<div id="divTableDataHolder" style='overflow-y: scroll'>				
<!--<h2>Holiday work Allocation Report on <?php echo $valid_from ;?></h2>-->				
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="sorter" style="font-size: 12px;overflow: auto;">  
<thead>				
<tr style="color:#0033FF">		
<th> # </th>				
<th>ECODE</th>
<th>EName</th>
<th>DOB</th>
<th>DEPARTMENT</th>
<th>DIVISION</th>
<th>SECTION</th>
<th>Working Days</th>
<th>PD WAGE</th>
<th>PD ALLOW</th>
<th>PD INCEN</th>
<th>BASIC</th>
<th>OTHER ALLOW</th>
<th>INCEN</th>
<th>PF</th>
<th>ESI</th>
<th>PTF</th>
<th>Sal_ded</th>
<th>TOTDED</th>
<th>GROSS</th>		
<th>NETPAY</th>
</tr>
</thead>
<tbody>						

	<?php
	/* 
	$attendance_day_cal = sqlsrv_query($conn,"select count(IDCARDNO) as no_of_dys,IDCARDNO,CNAME from employee_attendance_jan where CCODE='CT0745' group by IDCARDNO,CNAME order by CNAME");
	*/
	
    $emp_att=$con->query("select count(emp_id) as no_of_dys,emp_id,shift_date,in_time,	out_time from employee_attendance where shift_date >='2021-01-01' 
	group by emp_id,shift_date,in_time,out_time order by emp_id");
     
	
	$cnt=1;

	 while($employee_att_res = $emp_att->fetch(PDO::FETCH_ASSOC))
        {
		$pf_amount=0;
		
	    $EMPNO=$employee_att_res['emp_id'];				
		$DAYS=$employee_att_res['no_of_dys'];
		//$CNAME=$employee_att_res['CNAME'];	
		
		$employee_attendance=$con->query("select * from employee_master where code ='$EMPNO'");
        

	
		$emp_master_res = $employee_attendance->fetch();

		
		$ECODE = $emp_master_res['code'];
		$ENAME=$emp_master_res['name'];
		$DOB=$emp_master_res['dob'];	
		$DEPARTMENT=$emp_master_res['department'];				
		$DIVISION=$emp_master_res['division'];
		$SECTION=$emp_master_res['section'];


		/*$pdwage=$emp_master_res['pd_wage'];
		$pdallow=$emp_master_res['pd_allowance'];
		$pdincen=$emp_master_res['pd_incentive'];
		
		$basic=($days*$pdwage);
		$other_allowance=($days*$pdallow);
		$incentive=($days*$pdincen);
		
		$pt_deduction="select * from PTDeduction where code='$ECODE'";
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
			
			
			$pt_deduction_result =0;
			
			$payroll_advance_deduction="select * from payroll_salary_deduction where code='$ECODE'";
			$payroll_advance_deduction_query=sqlsrv_query($conn,$payroll_advance_deduction);
			$payroll_advance_deduction_query_execute=sqlsrv_fetch_array($payroll_advance_deduction_query, SQLSRV_FETCH_ASSOC);
			
			$advance_amount=$payroll_advance_deduction_query_execute['advance_amount'];
			
			$net_pay = $gross-$total_deduction-$pt_deduction_result; */
			
			?>
			<tr>
			<td><?php echo htmlentities($cnt);?></td>
			<td><?php echo htmlentities($ECODE);?></td>
			<td><?php echo htmlentities($ENAME);?></td>
			<td><?php echo htmlentities($DOB);?></td>
			<td><?php echo htmlentities($DEPARTMENT);?></td>
			<td><?php echo htmlentities($DIVISION);?></td>			
			<td><?php echo htmlentities($SECTION);?></td>
			<td><?php echo htmlentities($DAYS);?></td>
			
			<!--<td><?php echo htmlentities($pdwage);?></td>
			<td><?php echo htmlentities($pdallow);?></td>
			<td><?php echo htmlentities($pdincen);?></td>
			<td><?php echo htmlentities($basic);?></td>
			<td><?php echo htmlentities($other_allowance);?></td>
			<td><?php echo htmlentities($incentive);?></td>
			<td><?php echo htmlentities($pf_amount);?></td>
			<td><?php echo htmlentities($esi_amount);?></td>
			<td><?php echo htmlentities($pt_deduction_result);?></td>
			<td><?php echo htmlentities($advance_amount);?></td>
			<td><?php echo htmlentities($total_deduction);?></td>
			<td><?php echo htmlentities($gross);?></td>
			<td><?php echo htmlentities(round($net_pay,2));?></td>
			</tr>
			<?php
		$cnt++;
		}
		?>			
		<tr>
		<td>
		</td>
		</tr>
		</tbody>		
		</table>
		</div><!-- /.mail-box-messages -->
		</div><!-- /.box-body -->                
		</div><!-- /. box -->
		</div><!-- /.col -->
		</div><!-- /.row -->
		</div>
		</div>