<?php

	require '../../connect.php';
	
	
	$from_date = $_REQUEST['from_date1'];	
	$from_date=date("Y-m-d",strtotime($from_date));
	
	$to_date = $_REQUEST['to_date1'];
	
	$month = $_REQUEST['month1'];
	$month = explode("-",$month);	
	$year=$month[0];
	$month_number=$month[1];
	$dep_id = $_REQUEST['department_id'];
					
	if($from_date=="1970-01-01")
	{
		$from_date1="1-".$month_number."-".$year;
		$from_date=date("Y-m-d",strtotime($from_date1));
		$to_date=date("Y-m-t",strtotime($from_date));
	}

	$fromdate = $from_date;
	$todate = $to_date;

	$dateMonthYearArr = array();
	$from_dateTS = strtotime($fromdate);
	$to_dateTS = strtotime($todate);
	
	
	for ($currentDateTS = $from_dateTS; $currentDateTS <= $to_dateTS; $currentDateTS += (60 * 60 * 24)) 
	{
		$currentDateStr = date("Y-m-d",$currentDateTS);
		$dateMonthYearArr[] = $currentDateStr;
	}
	
	
	$datequery=$con->query("select leave_date from Holiday_master where year=$year and status=1");	
	while($result_query= $datequery->fetch(PDO::FETCH_ASSOC))	
	{
		$arrdate[]=$result_query['leave_date'];
	}
	

				
	
	class attendance_report
	{
		public $fromdate;
		public $todate;
		public $dateMonthYearArr;
		public $dep_id;
		public $arrdate;
		
		function Daily_Report($con,$fromdate,$todate,$arrdate,$dateMonthYearArr,$dep_id)
		{
			
			
			$output = '<table class="" id="example1">
			<thead>
			<tr>
			<tr>			
			<th style="color:blue;">#</th>
			<th style="color:blue;">Emp Code</th>
			<th style="color:blue;">Name</th>
			<th style="color:blue;">Department</th>';	
			for($i=0;$i<sizeof($dateMonthYearArr);$i++)
			{
				$output .= "<th style='color:blue;'>".$day_cnt=date("d",strtotime($dateMonthYearArr[$i]))."</th>";
			}

			$output .= "<th style='color:blue;'>Total Day</th>
			<th style='color:blue;'>Total Working</th>
			<th style='color:blue;'>Total Holiday</th>
			<th style='color:blue;'>Total Present</th>
			<th style='color:blue;'>Total Leave</th></tr></thead><tbody>";
			
			
			$e=1;
			$emp_list_sql = $con->query("SELECT * FROM staff_master  where dep_id='$dep_id' order by emp_code ASC");
			while($emp_list_res = $emp_list_sql->fetch(PDO::FETCH_ASSOC))
			{
				$emp_code = $emp_list_res['emp_code'];
				
				$output .= '<tr>
							<td>'.$e.'</td>
							<td>'.$emp_code.'</td>
							<td>'.$emp_list_res['emp_name'].'</td>
							<td>'.$emp_list_res['dep_id'].'</td>';
		
			$sun=0;
			$a=0;
			$sat=0;
			$sat_count = 1;
			$total_working_Day = 0;
			for($i=0;$i<sizeof($dateMonthYearArr);$i++)
			{
				$date=$dateMonthYearArr[$i];
				$day=date('D',strtotime($date));
				$xx=count($dateMonthYearArr);				
				
				if($day == "Sat")
				{
					
					if(($sat_count%2) == 0)
					{
						$rs="H";
						$clr="blue";
						$sat=$sat+1;
					}
					else
					{
						$rs="A";
						$clr="RED";
					}
				
					$sat_count++;
				}
				
				$attendance_check_sql = $con->query("SELECT COUNT(*),Date FROM employee_attendance where 
				Direction = 'in' and EmployeeCode='$emp_code'  and date ='$date'");

				$count = $attendance_check_sql->fetchColumn();		

				if($count>0)
				{
					$rs="P";
					$clr="GREEN";
					$total_working_Day++;
				}
				else if($day != "Sat" && $day!="Sun")
				{
					$rs="A";
					$clr="RED";
				}

				if(($day=="Sun")|| (in_array($date, $arrdate)))	
				{
					$rs="H";
					$clr="blue";
					$sun=$sun+1;
				}

				$output .= "<td style='color:$clr'>".$rs."</td>";

				//echo $sat;
				
			}
			
			$total_holiday = $sun+$sat;
			$overall_present = $total_working_Day+$total_holiday;
			$absent = $xx-$overall_present;
				
				$output .= '<td>'.$xx.'</td>
							<td>'.$total_working_Day.'</td>
							<td>'.$total_holiday.'</td>
							<td>'.$overall_present.'</td>
							<td>'.$absent.'</td>
							</tr>';
				$e++;			
			}
			
			
			$output .= '</tbody>
						</table>
						</div>
						</div>
						</div>
						</div>
						</div>';
				
			return $output;
		}
	}
	
	$obj = new attendance_report();	
	$obj->Daily_Report($con,$from_date,$to_date,$arrdate,$dateMonthYearArr,$dep_id)
	
	?>
	
	<div class="container-fluid">
	<br>
	<div class="row content">
	<div class="col-lg-12">
	<div class="panel panel-default">
	<div class="panel-heading">Daily_Report</div>
	<div class="panel-body">
	<div class="table-responsive">
	<?php
	echo $obj->Daily_Report($con,$from_date,$to_date,$arrdate,$dateMonthYearArr,$dep_id);
	?>	
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	
	