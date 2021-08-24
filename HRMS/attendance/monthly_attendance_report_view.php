	<?php
	require '../../connect.php';
	date_default_timezone_set("Asia/Kolkata");
	$curdate=date("d-m-y");

	
	//from_date=2021-06-01&to_date=2021-06-24&month_value=2018-05&department_id=1

	$from_date = $_REQUEST['from_date'];
	$to_date = $_REQUEST['to_date'];
	$month_value = $_REQUEST['month_value'];
	$department_id = $_REQUEST['department_id'];
	
	/* $from_date = '2021-03-01';
	$to_date = '2021-03-31';
	$month_value = '03';
	$department_id = 2; */
	
	?>
	<div class="col-12">
	<!-- Default box -->
	<div class="card">
	<div class="card-header">
	<h3 class="card-title">Attendance Monthly Report Between <?php echo date("d-m-Y",strtotime($from_date)) ;?> 
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
		<th rowspan="2" style="color:blue;">#</th>
		<th rowspan="2" style="color:blue;">Emp Code</th>
		<th rowspan="2" style="color:blue;">Name</th>
		<th rowspan="2" style="color:blue;">Department</th>		

		</tr>

		<?php
		
		$r=0;
		$a=0;
		$v=0;

		$from_date=date("Y-m-d",strtotime($from_date));
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
		for ($currentDateTS = $from_dateTS; $currentDateTS <= $to_dateTS; $currentDateTS += (60 * 60 * 24)) {
		$currentDateStr = date("Y-m-d",$currentDateTS);
		$dateMonthYearArr[] = $currentDateStr;
		}
		for($i=0;$i<sizeof($dateMonthYearArr);$i++)
		{
		?>
		<th style="color:blue;"><?php echo $day_cnt=date("d",strtotime($dateMonthYearArr[$i])); ?></th><?php
		}?>
		
	
		<th style="color:blue;">Total Day</th>
		<th style="color:blue;">Total Working</th>
		<th style="color:blue;">Total Holiday</th>
		<th style="color:blue;">Total Present</th>
		<th style="color:blue;">Total Leave</th>


		<?php

		If($department_id=='All')
		{
			$vv="";
		}
		else
		{
			$vv="and a.dep_id in ('$department_id')";
		}

	
		

		$inndate1=$con->query("SELECT candid_id, prefix_code, emp_code, emp_name, dep_id, div_id, design_id FROM staff_master a left join z_department_master b on a.dep_id=b.id where a.status=1 $vv order by emp_code asc ");
		
		$s=1;
		
		$datequery=$con->query("select leave_date from Holiday_master where year=year('$fromdate')");
		while($result_query = $datequery->fetch(PDO::FETCH_ASSOC))	
		{
			$arrdate[]=$result_query['leave_date'];
		}
		//print_r($arrdate);
		while($indate=$inndate1->fetch(PDO::FETCH_ASSOC))
		{
		?>
		<tr>
		<td><?php echo $s++;?> </td>
		<td><?php echo "EMP-".$indate['emp_code']; ?></td>
		<td><?php echo $indate['emp_name']; ?></td>
		<td><?php echo $indate['dep_id']; ?></td>

		<?php
		$emp_id=$indate['emp_code'];
		$fromdate = $from_date;
		$todate = $to_date;
		
		
		/* $inndate11=sqlsrv_fetch_array(sqlsrv_query($con,"select e.emp_id,e.name,a.in_time,a.out_time,a.customer_name,a.location,a.purpose,a.attendance,case when a.attendance is null then 'L' else 'P' end as att,case when a.attendance is null then 'red' else 'black' end as clr,dm.Dep_name from (select EmpId as empid, convert(char(5), min(LogDataTime), 108) as in_time,
		convert(char(5), max(LogDataTime), 108) as out_time,'Bio-Metric' as attendance,'' as customer_name,'' as location,'' as purpose from [etimeparallel].[dbo].[Attlogs] where EmpId in (select emp_id from emp_master)
		and convert(date,LogDataTime,120)=convert(date,'$date',120) group by EmpId
		union 
		select emp_id as empid,'' as in_time,'' as out_time,'Manual' as attendance,customer_name,location,purpose
		from manual_att where emp_id in (select emp_id from emp_master) and date=convert(date,'$date',120)  )a
		right join emp_master e on e.emp_id=a.empid join Dep_master dm on dm.id=e.dep_id where emp_id='$emp_id' order by e.emp_id asc")); */

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
		
			

		if(($day=="Sun")||(in_array($date, $arrdate)))	
		{
			$rs="H";
			$r=$r+1;
		}		
		else
		{
			$rs=$inndate11['att'];
			$clr=$inndate11['clr'];
		}	
		
		$cur=date("Y-m-d");
		
		if($cur<$date)
		{
			$rs="";
			if($day=="Sun")		
			{
				$r=$r-1;
			}
		} 
		if($rs=="P")
		{
			$a=$a+1;
		}
		if($rs=="L")
		{
			$v=$v+1;
		}
		?> 
		<td style="color:<?php echo $clr; ?>"><?php echo $rs; ?></td>
		<?php

		?><?php 
		}
		?>
		<td><?php  echo $day_cnt;?></td>	
		<td><?php  echo $day_cnt-$r;?></td>	
		<td><?php  echo $r;$r=0;?></td>	
		<td><?php  echo $a;$a=0;?></td>	
		<td><?php  echo $v;$v=0;?></td>	

		<?php
		}
		?>		
		</tr>			
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