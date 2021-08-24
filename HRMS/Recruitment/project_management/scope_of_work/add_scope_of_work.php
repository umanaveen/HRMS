<?php
require '../../../../connect.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("select a.Project_Name,b.client_name,a.scope_of_project from project_management a LEFT JOIN client_master b on a.client=b.id where a.project_id='$id'");
//echo "select a.Project_Name,b.client_name,a.scope_of_project from project_management a LEFT JOIN client_master b on a.client=b.id where a.project_id='$id'";
$stmt->execute(); 
$row = $stmt->fetch();
//$sid=$row['emp_name'];
//$pid=$row['dep_id'];
?>
<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> PROJECT DETAILS EDIT
<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
</div>
<div class="card-body" id="printableArea">
<form role="form" name="" action="HRMS/Recruitment/project_management/scope_of_work/update_scope_of_work.php" method="post" enctype="multipart/type">

<table class="table table-bordered">
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
 <td>Client:</td>
	 <td colspan="2">
		<input type="text" class="form-control" id="client" name="client" readonly value="<?php echo $row['client_name']; ?>"></td>
	 </td>
</tr>
<tr>
<td>Project Name:</td>
<td colspan="2">
<input type="text" class="form-control" id="project_name" name="project_name" readonly value="<?php echo $row['Project_Name']; ?>"></td>

</tr>
 <table class="table table-bordered" id="new_tab">

</td>
</tr>
<td>Scope of Work</td>
<td colspan="2">
<textarea id="scope_of_project" name="scope_of_project" class="form-control" style="height:600px"><?php if($row['scope_of_project']!="") { echo $row['scope_of_project']; } ?></textarea>


<tr id="new">
	<td>
	</td>
	  </tr>

</table>
<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">
<input type="hidden" id="pro_id" name="pro_id" value="<?php echo $id; ?>" />
</form>
<script>
		function back()
    {
		
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/Recruitment/project_management/scope_of_work/scope_of_work_list.php",
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  
  $(function () {
//Add text editor
$('#scope_of_project').summernote()
})

$(document).ready(function(){
  $("form").submit(function(){
    alert("SCOPE SUBMITTED SUCCESSFULLY");
  });
});
  </script>