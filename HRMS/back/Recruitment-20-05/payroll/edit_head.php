<?php
require '../../connect.php';
echo "hii".$id=$_REQUEST['id'];
 $edit_id=$con->query("select * from payroll_scale_master where id='$id'");
$res = $edit_id->fetch();
?>

<div class="content-wrapper" id="main_content">
<div class="container-fluid">
  <div class="card mb-3">
    <div class="card-header">
	
      <i class="fa fa-table"></i> Scale Master
<a onclick="scale_master()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a>
	  </div>
    <div class="card-body">
	 <form method="POST">
		  <div class="form-group row">
			<label for="Scale" class="col-sm-2 col-form-label"> Name</label>
			<div class="col-sm-10">
			
			  <input type="text"  class="form-control" id="scale" name="scale" value="<?php echo $res[0]; ?>">
			</div>
		  </div>
		  <div class="card-body">
	 <form method="POST">
		  <div class="form-group row">
			<label for="status" class="col-sm-2 col-form-label"> Status</label>
			<div class="col-sm-10">
<select class="form-control" name="status" id="status">
<option value="">Select Status</option>
<option value="1">Active</option>
<option value="0">InActive</option>
</select>
			</div>
		  </div>
		 
		 
		  <!--div class="form-group row">
			<label for="da" class="col-sm-2 col-form-label">Da</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="da" name="da" value="<?php echo $res['da']; ?>" placeholder="DA Amount">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="hra" class="col-sm-2 col-form-label">Hra</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="hra" name="hra" value="<?php echo $res['hra']; ?>" placeholder="Hra Amount">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="cca" class="col-sm-2 col-form-label">Cca</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="cca" name="cca" value="<?php echo $res['cca']; ?>" placeholder="Cca Amount">
			</div>
		  </div><div class="form-group row">
			<label for="bonus" class="col-sm-2 col-form-label">Bonus</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="bonus" name="bonus" value="<?php echo $res['bonus']; ?>" placeholder="Bonus Amount">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="Add_Allowance" class="col-sm-2 col-form-label">Additional Allowance</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="add_allowance" name="add_allowance" value="<?php echo $res['addition_allowance']; ?>" placeholder="Additional Allowance">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="Others" class="col-sm-2 col-form-label">Others</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="others" name="others" value="<?php echo $res['others']; ?>" placeholder="Other Amount">
			</div>
		  </div-->
		  <div class="form-group row">
			<div class="col-sm-10"></div>
			<div class="col-sm-2">
			  <input type="button" class="btn btn-primary btn-md" id="<?php echo $id; ?>" onclick="scale_update()" value="Update">
			</div>
		  </div>
	</form>
    </div>
  </div>
</div>
</div>
<script>
function scale_master()
{
  $.ajax({
    type:"POST",
    url:"/Recruitment/Recruitment/payroll/scale_head.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function scale_update(v)
{
	var id=v;
	alert(id);
	 var data = $('form').serialize();
	$.ajax({
		type:'GET',
		data:"id="+id, data,
		url:'/Recruitment/Recruitment/payroll/head_update.php',
		success:function(data)
		{
			 if(data==0)
			{
				alert("Updated Scale Head");
				//scale_master();
			}
			else
			{
				alert("Not Updated Scale Head");
				//scale_master();
			} 	
		}       
	}); 
}
</script>
