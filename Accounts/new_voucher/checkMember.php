<?php
require("../configuration.php");
$member_no=$_REQUEST['member_no'];

if(is_numeric($member_no))
{
	if($member_no==10201 || $member_no==10203 || $member_no==10204)
	{
	$staff_sql="SELECT s.name FROM staff s WHERE member_no='$member_no' ";
	$staff_row=mysql_query($staff_sql);
	$staff_res=mysql_fetch_array($staff_row);
	echo $staff_res['name']."=".''."=".'';
	}
	else
	{
		$dem_check=mysql_query("SELECT * FROM demand WHERE member_no='$member_no' and flag_id='8'");
		$row=mysql_num_rows($dem_check);
		
		$member_sql="SELECT m.name,b.code as branch_code,b.name as branch_name,m.mobile_no,m.member_no FROM member m JOIN branch b 
		ON b.code=m.branch_code WHERE member_no='$member_no'";
		$member_row=mysql_query($member_sql);
		$check_member=mysql_num_rows($member_row);
		$member_res=mysql_fetch_array($member_row);

		echo $member_res['name']."=".$member_res['branch_code']."=".$member_res['branch_name']."=".$member_res['mobile_no']."=".$row."=".$member_res['member_no'];
	}
}
?>