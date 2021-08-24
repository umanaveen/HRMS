<?php
require '../../connect.php';
echo "hii".$ids=$_REQUEST['ids'];
 $edit_id=$con->query("select * from payroll_structure where id='$ids'");
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
			
			  <input type="text"  class="form-control" id="scale" name="scale" value="<?php echo $res[1]; ?>">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="text" class="col-sm-2 col-form-label">Type</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" id="type" name="type" value="<?php echo $res[2]; ?>" placeholder="type">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="basicpay" class="col-sm-2 col-form-label">Amount</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="amount" name="amount" value="<?php echo $res[3]; ?>" placeholder="Amount">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="spl_pay" class="col-sm-2 col-form-label">Percentage</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="percentage" name="percentage" value="<?php echo $res[4]; ?>" placeholder="Percentage">
			</div>
		  </div>
		 
		  <div class="form-group row">
			<div class="col-sm-10">
			  <input type="hidden"  class="form-control" id="grade_pay" name="grade_pay" value="<?php echo $res[0]; ?>" placeholder="Grade Pay Amount">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="text" class="col-sm-2 col-form-label">Status</label>
			<div class="col-sm-10">
			<select id="status" name="status" class="form-control" >
 
<?php 
if($res[12] ==1)
{
?>
    <option value="1">Active</option>
	 <option value="2"> IN Active</option>
<?php }else {?>
  <option value="2"> IN Active</option>
  <option value="1">Active</option>
<?php } ?>
</select>
			</div>
		    </div>
		  <div class="form-group row">
			<div class="col-sm-10"></div>
			<div class="col-sm-2">
			<input type="hidden" name="sname" id="sid" value="<?php echo $res[0];?>">
			  <input type="button" class="btn btn-primary btn-md" id="<?php echo $ids; ?>" onclick="scale_update(this.id)" value="Update">
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
    url:"/HRMS/HRMS/scale_master/main.php",
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
		url:'/HRMS/HRMS/scale_master/scale_update.php',
		success:function(data)
		{
			 if(data==0)
			{
				alert("Updated Scale Master");
				scale_master();
			}
			else
			{
				alert("Not Updated Scale Master");
				scale_master();
			} 	
		}       
	}); 
}
</script>
