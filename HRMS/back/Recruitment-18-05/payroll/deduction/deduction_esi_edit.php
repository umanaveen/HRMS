<?php
require '../../../connect.php';
echo "hii".$ids=$_REQUEST['ids'];
 $edit_id=$con->query("select * from payroll_deduction_master where id='$ids'");
$res = $edit_id->fetch();
?>

<div class="content-wrapper" id="main_content">
<div class="container-fluid">
  <div class="card mb-3">
    <div class="card-header">
	
      <i class="fa fa-table"></i>DEDUCTION EDIT 
<a onclick="esi_back()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a>
	  </div>
    <div class="card-body">
	 <form method="POST">
		  <div class="form-group row">
<label for="Earnings" class="col-sm-2 col-form-label"> Name</label>
<div class="col-sm-10">
<input type="text"  class="form-control" id="name" name="name" value="<?php echo  $res[1]; ?>">
</div>
</div>
			<div class="form-group row">
<label for="from_date" class="col-sm-2 col-form-label"> From Date</label>
<div class="col-sm-10">
<input type="date"  class="form-control" id="from_date" name="from_date" value="<?php echo  $res[2]; ?>">
</div>
</div>
<div class="form-group row">
<label for="number" class="col-sm-2 col-form-label">Amount</label>
<div class="col-sm-10">
<input type="number"  class="form-control" id="amount" name="amount" value="<?php echo  $res[3]; ?>">
</div>
</div>
			<div class="form-group row">
<label for="percentage" class="col-sm-2 col-form-label">Percentage</label>
<div class="col-sm-10">
<input type="number"  class="form-control" id="percentage" name="percentage" value="<?php echo  $res[4]; ?>">
</div>
</div>
			<div class="form-group row">
<label for="min_amount" class="col-sm-2 col-form-label">Minimum Amount</label>
<div class="col-sm-10">
<input type="number"  class="form-control" id="min_amount" name="min_amount" value="<?php echo  $res[5]; ?>">
</div>
</div>
				<div class="form-group row">
<label for="max_amount" class="col-sm-2 col-form-label">Maximum Amount</label>
<div class="col-sm-10">
<input type="number"  class="form-control" id="max_amount" name="max_amount" value="<?php echo  $res[6]; ?>">
</div>
</div>
		  <div class="form-group row">
			<label for="text" class="col-sm-2 col-form-label">Status</label>
			<div class="col-sm-10">
			<select id="status" name="status" class="form-control" >
 
<?php 
if($res[7] ==1)
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
		  <!--div class="form-group row">
			<div class="col-sm-10">
			  <input type="hidden"  class="form-control" id="grade_pay" name="grade_pay" value="<?php echo $res[0]; ?>" placeholder="Grade Pay Amount">
			</div>
		  </div-->
		  
		  <div class="form-group row">
			<div class="col-sm-10"></div>
			<div class="col-sm-2">
			<input type="hidden" name="sname" id="sid" value="<?php echo $res[0];?>">
			  <input type="button" class="btn btn-primary btn-md" id="<?php echo $ids; ?>" onclick="esi_update(this.id)" value="Update">
			</div>
		  </div>
	</form>
    </div>
  </div>
</div>
</div>
<script>
function esi_back()
{ 
alert("mmm");
	 $.ajax({
    type:"POST",
    url:"/Recruitment/Recruitment/payroll/deduction/deduction_esi.php",
    success:function(data)
	{
      $("#main_content").html(data);
    }
  }) 
}
</script>
<script>
function esi_update(v)
{
	
	 var data = $('form').serialize();
	$.ajax({
		type:'GET',
		data:"id="+v, data,
		url:'/Recruitment/Recruitment/payroll/deduction/deduction_esi_update.php',
		success:function(data)
		{
			 if(data==1)
			{
				alert("Not Updated Deduction Master");
				esi_back();
			}
			else
			{
				alert("Updated Deduction Master");
				esi_back();
			} 	
		}       
	}); 
}
</script>
