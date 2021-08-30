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
<i class="fa fa-table"></i> calls  Add
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
        <td colspan="6"><center><b>Add calls</b></center></td>
        </tr>
		
        
		
     
        <tr>
        <td>Client Organisation Name</td>
        <td colspan="5"><input type="text" class="form-control" id="client_org" name="client_org"></td>
        </tr>
		<tr>
        <td>Client Name</td>
        <td colspan="5"><input type="text" class="form-control" id="client_name" name="client_name"></td>
        </tr>
      <tr>
        <td>Contact Number</td>
        <td colspan="5"><input type="text" class="form-control"id="contact" name="contact"></td>
        </tr>
      <tr>
        <td>Email Id</td>
        <td colspan="5"><input type="text" class="form-control" id="email" name="email"></td>
        </tr>
      <tr>
        <td>Website</td>
        <td colspan="5"><input type="text" class="form-control" id="website" name="website"></td>
        </tr>
      <tr>
        <td>Address</td>
        <td colspan="5"><input type="text" class="form-control" id="address" name="address"></td>
        </tr>
      <tr>
        <td>City</td>
        <td colspan="5"><input type="text" class="form-control" id="	" name="city"></td>
        </tr>
      <tr>
        <td>State</td>
        <td colspan="5"><input type="text" class="form-control" id="state" name="state"></td>
        </tr>
      <tr>
        <td>Country</td>
        <td colspan="5"><input type="text" class="form-control" id="country" name="country"></td>
        </tr>
      
		
       
		
		
		
		 
		
		
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="insert_calls()" value="save"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>

			<script>
			 function insert_calls()
    {
    var id=0;
	//alert(id);
    var data = $('form').serialize();
//alert(data);
    $.ajax({
    type:'GET',
    data:"id="+id, data,
  url:"HRMS/CRm/Calls/calls_submit.php",
    success:function(data)
    {      
        alert("Entry Successfully");
		 calls()
		          
    }       
    });
    }
	function back()
	
	{
		 calls()

	}
	</script>