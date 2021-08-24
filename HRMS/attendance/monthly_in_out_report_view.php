	<?php
	require '../../connect.php';
	date_default_timezone_set("Asia/Kolkata");
	$curdate=date("d-m-y");

	$from_date = $_REQUEST['from_date'];
	$to_date = $_REQUEST['to_date'];
	$month_value = $_REQUEST['month_value'];
	$department_id = $_REQUEST['department_id'];	
	?>
	<div class="col-12">
	<!-- Default box -->
	<div class="card">
	<div class="card-header">
	<h3 class="card-title">Monthly IN OUT Report Between <?php echo date("d-m-Y",strtotime($from_date)) ;?> 
		and <?php echo date("d-m-Y",strtotime($to_date));?></h3>
	</div>
	<div class="card-body">
		<div class="box-body">
				<div class="row">
				<div class="col-xs-12" style="overflow-x: scroll;">
				<div id="printableArea">
				<div id="divTableDataHolder">
				<table class="table table-hover"  border=1> 									  
				<tr>			
				<th rowspan="3">#</th>
				<th rowspan="3">Emp Code</th>
				<th rowspan="3">Name</th>
				</tr>
				
				<?php
			   
					$late=0;
					$before=0;
					
					$uni=$department_id;
					$mon=03;
					
					$from_date=$_REQUEST['from_date'];
					$from_date=date("Y-m-d",strtotime($from_date));
					$to_date=$_REQUEST['to_date'];
					$to_date=date("Y-m-d",strtotime($to_date));
					
					if($from_date=="1970-01-01")
					{
						$from_date1="1-".$mon;
						$from_date=date("Y-m-d",strtotime($from_date1));
						$to_date=date("Y-m-t",strtotime($from_date));
					}
				
				$fromdate = $from_date;
				$todate = $to_date;

				$dateMonthYearArr = array();
				$from_dateTS = strtotime($fromdate);
				$to_dateTS = strtotime($todate);
				
				for($currentDateTS = $from_dateTS; $currentDateTS <= $to_dateTS; $currentDateTS += (60 * 60 * 24))
				{
					$currentDateStr = date("Y-m-d",$currentDateTS);
					$dateMonthYearArr[] = $currentDateStr;
				}
				
				for($i=0;$i<sizeof($dateMonthYearArr);$i++)
				{
					?>
					<th style="color:blue;text-align:center;" colspan='3'><?php echo date("d",strtotime($dateMonthYearArr[$i])); ?></th>
					<?php
				}
				?><th></th><th></th></tr><tr>
				<?php
				for($i=0;$i<sizeof($dateMonthYearArr);$i++)
				{
				?><th style="color:green;"><?php echo "IN";?></th>
				<th style="color:red;"><?php echo "OUT"; ?></th>
				<th style="color:Blue;"><?php echo "ATT"; ?></th>
				<?php
				}?>
				<th>After 9:15</th>
				<th>Before 9:00</th>
				
				
				<?php
				if($department_id=="All")
				{
					$re="";
				}
				else
				{
					$re="and e.dep_id in ('$department_id')";
				}
				
				//$inndate1=sqlsrv_query($con,"");
				
				$inndate1 = $con->query("select dm.id,e.emp_code,e.emp_name,dm.dept_name from staff_master e join z_department_master dm on e.dep_id=dm.id $re");
			
			$s=1;
			
			while($indate = $inndate1->fetch(PDO::FETCH_ASSOC))
			{
				?>
				<tr>
				<td><?php echo $s++;?> </td>
				<td><?php echo "EMP".'-'.$indate['emp_code']; ?></td>
				<td><?php echo $indate['emp_name']; ?></td>
				
				<?php
				$emp_id=$indate['emp_code'];
				$fromdate = $from_date;
				$todate = $to_date;
				
				$sum=0;
				for($i=0;$i<sizeof($dateMonthYearArr);$i++)
				{
					
					$date=$dateMonthYearArr[$i];
					$day=date('D',strtotime($date));
					$xx=count($dateMonthYearArr);
				
				
				$dayquery=$con->query("select 
					a.EmployeeCode,
					a.in_time,
					a.out_time,
					a.attendance,
					case when a.attendance is null then 'L' else 'P' end as att,
					case when a.attendance is null then 'red' else 'black' end as clr
					from 
					(select EmployeeCode as EmployeeCode, min(LogTime) as in_time,max(LogTime) as out_time,'Bio-Metric' as attendance from employee_attendance where EmployeeCode in (select emp_code from staff_master) and Date='$date'
					union
					select emp_id as empid,'' as in_time,'' as out_time,'Manual' as attendance from manual_att where emp_id in (select emp_code from staff_master) and date='$date')a");
					
					$inndate11=$dayquery->fetch(PDO::FETCH_ASSOC);
							
				if($day=="Sun")		
				{
					$rs="H";
					$rs1="H";
					$rs2="H";
					$clr="blue";
				}
				else
				{
					$rs=$inndate11['in_time'];
					$rs1=$inndate11['out_time'];
					$rs2=$inndate11['att'];
					$clr=$inndate11['clr'];
				}	
				$cur=date("Y-m-d");
				if($cur<$date)
				{
					$rs="";
					$rs1="";
					$rs2="";
				}
				if($inndate11['att']=="P" && $inndate11['in_time']==" ")
				{
					$rs="M";
					$rs1="M";
				}
				if($inndate11['in_time']>"09:15")
				{
					$late++;
				}
				if($inndate11['in_time']<"09:00" && $rs!="M" && $rs!="H" && $rs!="")
				{
					$before++;
				}
				?> 
			<td style="color:<?php echo $clr; ?>"><?php if($rs=='M'){echo  $inndate11['customer_name'];}else{ echo $rs; }?></td>
			<td style="color:<?php echo $clr; ?>"><?php if($rs1=='M'){echo  $inndate11['customer_name'];}else{ echo $rs1; } //echo $rs1; ?></td>
			<td style="color:<?php echo $clr; ?>"><?php echo $rs2; ?></td>
				<?php
				
				?><?php 
				}
				?>
				
				
			<td style="color:<?php echo $clr; ?>"><?php echo $late;$late=0; ?></td>
			<td style="color:<?php echo $clr; ?>"><?php echo $before;$before=0; ?></td>
				<?php
			    }
			    ?>			
								
				</table>
				</div>
				</div>
				</div>
				</div>
				
				</div>

	</div>
	<!-- /.card-body -->
	</div>
	<!-- /.card -->
	</div>