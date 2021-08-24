<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];

?>
<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header">
<i class="fa fa-table"></i> ADD RESOURCE
<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-primary"></i>Back</a>
</div>
<div class="card-body">
<div class="tab-content">

    <div class="active tab-pane" id="for_employment">
    <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
        <tr>
        <td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
        <td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
        </tr>
      
        <tr>
        <td colspan="6"><center><b>Add Resource</b></center></td>
        </tr>
		
        
		
     
        <tr>
        <td>Resource Name</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Resource Name" id="resource" name="resource"></td>
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
       
		
        <td colspan="6"><input type="button" class="btn btn-success" value="Save"  name="submit" onclick="insert_resource()" value="save"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>

			<script>
			 function insert_resource()
    {
    var id=0;
	//alert(id);
    var data = $('form').serialize();
//alert(data);
    $.ajax({
    type:'GET',
    data:"id="+id, data,
  url:"HRMS/masters/Resource_master/resource_submit.php",
    success:function(data){
		if(data==0)
		{
			alert("inserted successfully");
			resource_master();
		}
		else
		{
			alert("Not inserted");
			resource_master();
		}
      //$("#main_content").html(data);
    }
	
    });
    }
	
	function back()
	
	{
		resource_master()

	}
	</script>