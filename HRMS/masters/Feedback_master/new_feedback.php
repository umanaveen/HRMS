<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>
<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> Feedback DETAILS 
<a onclick=" back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus"></i>Back</a>
</div>
<form method="POST" action="">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
<td>Feedback :</td>
<td colspan="2"><input type="text" class="form-control" id="feedback" name="feedback" ></td>
</tr>

<tr>
<td>Status</td>
<td colspan="2">
<select class="form-control" name="status" id="status">
<option value="">Select Status</option>
<option value="1">Active</option>
<option value="0">InActive</option>
</select>
</td>
</tr>
</table>
<input type="button" name="submit" class="btn btn-primary btn-md" value="Save" onclick="insert_feedback()"style="float:right;">
</form>
<script>
function insert_feedback()
{
    var id=0;
    var data = $('form').serialize();
  $.ajax({
    type:"GET",
	data: "id="+id, data,
    url:"/HRMS/HRMS/masters/feedback_master/insert_feedback.php",
    success:function(data){
		if(data=0)
		{
			alert("inserted successfully");
			feedback_master();
		}
		else
		{
			alert("Not inserted");
			feedback_master();
		}
      //$("#main_content").html(data);
    }
  })
}

function back_ctc()
{
	feedback_master();
}
</script>