<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
$candidateid=$_SESSION['candidateid'];

?>
<div class="container-fluid">
<div class="card mb-3">

<form method="POST" action="HRMS/performance_analysis/weekly_review_submit.php">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<!--input type="hidden" name="wid" id="wid" value="<!?php echo  $wid; ?>"-->
<table class="table table-bordered">
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
<td>Employee</td>

	<?php
	$sta=$con->query("select * from staff_master where status=1");
	?>
	<td>
	<select name="emp_name" id="emp_name" class="form-control" onchange="get_data(this.value)" >
	<option value="">Select Employee</option>
	<?php 
	while($dis=$sta->fetch())
	{
		?>
		
		<option value="<?php echo $dis['id'];?>"><?php echo $dis['emp_name'];?></option>
		<?php
	}
	?>
	</td>
</tr>
 
</table>

<table id="tabid" class="table table-bordered">
</table>


<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;" value="Update">


</form>

<script>
function get_data(v)
{
	$.ajax({
		type:"GET",
		url:"HRMS/performance_analysis/get_data.php?eid="+v,
		success:function(data)
		{
			$('#tabid').html(data);
		}
	})
	
}
</script>