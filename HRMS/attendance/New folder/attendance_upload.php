<?php

require '../../connect.php';
$date = date('Y-m-d');

if(isset($_POST["submit"]))
{  
	$file = $_FILES['file']['tmp_name'];
	$handle = fopen($file, "r");
	$c = 0;
	
	$row_insert = 0;
	while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
	{
		if($c !=0)
		{
			$EmployeeCode = $filesop[0];
			$LogDateTime = $filesop[1];
			$LogDate = $filesop[2];
			$LogTime = $filesop[3];
			$Direction = $filesop[4];
				
			$sql = "SELECT COUNT(*) FROM employee_attendance WHERE EmployeeCode='$EmployeeCode' and Date='$LogDate' and LogTime='$LogTime' and Direction='$Direction'";
			$res = $con->query($sql);
			$count = $res->fetchColumn();		
		
			if($count>0)
			{
				echo "Duplicate Member Number" .$EmployeeCode;
			}
			else
			{
				$sql=$con->query("INSERT INTO employee_attendance(EmployeeCode, Date, LogTime, Direction, status, created_by, created_on) values('$EmployeeCode', '$LogDate', '$LogTime', '$Direction', 1,1,'$date')");
				if($sql)
				{
					$row_insert = $row_insert+1;
				}
			}		
		}
		
	$c++;
	
	} 
	
	echo $row_insert .'-'."Number of rows inserted";
}	
?>