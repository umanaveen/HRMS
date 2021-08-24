<?php
require '../../connect.php';
$ids=$_REQUEST['ids'];
 $edit_id=$con->query("select * from master_addittion_allowance where id='$ids'");
$res = $edit_id->fetch();
?>

<div class="content-wrapper" id="main_content">
<div class="container-fluid">
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-table"></i> Allowance Master
	  <input type="button" style="float:right;" class="btn btn-warning" name="back" value="BACK" onclick="allowance_master()">
	  </div>
    <div class="card-body">
	<form method="POST">
		  <div class="form-group row">
			<label for="allowancename" class="col-sm-2 col-form-label">Allowance Name</label>
			<div class="col-sm-10">
			  <input type="hidden"  class="form-control" id="ids" name="ids" value="<?php echo $ids; ?>" placeholder="Allowance Name">
			  <input type="text"  class="form-control" id="allowance_name" name="allowance_name" value="<?php echo $res['allowance_name']; ?>" placeholder="Allowance Name"  autocomplete="off">
			</div>
		  </div>
		 <div class="form-group row">
			<label for="oname" class="col-sm-2 col-form-label">Short Name</label>
			<div class="col-sm-10">
			  <input type="text"  class="form-control" id="short_name" name="short_name" value="<?php echo $res['short_name']; ?>" placeholder="Other Name"  autocomplete="off">
			</div>
		  </div>
		  
		  <div class="form-group row">
			<div class="col-sm-10"></div>
			<div class="col-sm-2">
			  <input type="button" class="btn btn-primary btn-md" onclick="allowance_update()" value="Update">
			</div>
		  </div>
	</form>
    </div>
  </div>
</div>
</div>
<script>
function allowance_master()
{
  $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/addittion_allowance/main.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function allowance_update()
{
	var id="1";
	var data = $('form').serialize();
	$.ajax({
		type:'GET',
		data:"id="+id, data,
		url:'/HRMS/HRMS/addittion_allowance/allowance_update.php',
		success:function(data)
		{
			if(data!=0)
			{
				alert("Updated Additional Allowance");
				allowance_master();
			}
			else
			{
				alert("Not Updated Additional Allowance");
				allowance_master();
			}
		}       
	});
}
</script>

