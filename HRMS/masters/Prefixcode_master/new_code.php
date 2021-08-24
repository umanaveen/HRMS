<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>
<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> Preficxode DETAILS 
<a onclick=" back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-plus"></i>Back</a>
</div>
<form method="POST" action="">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
<td>Name :</td>
<td colspan="2"><input type="text" class="form-control" id="name" name="name" ></td>
</tr>
<tr>
<td>Code :</td>
<td colspan="2"><input type="text" class="form-control" id="code" name="code" ></td>
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
<input type="button" name="submit" class="btn btn-primary btn-md" value="Save" onclick="insert_prefix()"style="float:right;">
</form>
<script>
function insert_prefix()
{
	//alert("hiii");
    var id=0;
    var data = $('form').serialize();
   $.ajax({
    type:"GET",
	data: "id="+id, data,
    url:"/HRMS/HRMS/masters/Prefixcode_master/insert_prefix.php",
    success:function(data){
		if(data=0)
		{
			alert("inserted successfully");
			prefix_code();
		}
		else
		{
			alert("Not inserted");
			prefix_code();
		}
      //$("#main_content").html(data);
    }
  }) 
}

function back_ctc()
{
	prefix_code();
}
</script>