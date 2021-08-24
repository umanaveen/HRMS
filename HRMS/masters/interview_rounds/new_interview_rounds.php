<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>

              <div class="card card-info">
              <div class="card-header">
                
				              <center><h3 class="card-title"><b>Intrerview Round Add</b></h3></center>
		<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger">Back</a>
              </div>


<form method="POST" action="HRMS/masters/interview_rounds/interviewrounds_submit.php">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">


 <tr>
        <td><center><img src="/HRMS/HRMS/Recruitment/image/userlog/bluebase.png"  style="width:300px;height:150px;"></center></td>
        <td colspan="5"><center><h1><b>Bluebase Software services Pvt Ltd</b></h1></center></td>
        </tr>

<tr>
<td>Name:</td>
<td colspan="2"><input type="text" class="form-control" id="name" name="name"</td>
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

<input type="button" class="btn btn-success" name="save" onclick="insert_round()" value="save">
</form>
</div>
<script>
		function back()
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/masters/interview_rounds/interview_rounds.php",
    success:function(data){
 $("#main_content").html(data);
    }
    })
  }
  
function insert_round()
    {
    var id=0;
	//alert(id);
    var data = $('form').serialize();
	$("#main_content").html('<br><div style="text-align: center;"><img src="/HRMS/images/loader/loader.gif"></div>');
//alert(data);
    $.ajax({
    type:'GET',
    data:"id="+id, data,
    url:'HRMS/masters/interview_rounds/interviewrounds_submit.php',	
    success:function(data)
    {      
        alert("Entry Successfully");
		interview_rounds()
		          
    }       
    });
    }
  </script>
