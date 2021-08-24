<?php
require '../../connect.php';
echo "hii".$ids=$_REQUEST['ids'];
 $edit_id=$con->query("select * from master_scale_master where id='$ids'");
$res = $edit_id->fetch();
?>

<div class="content-wrapper" id="main_content">
<div class="container-fluid">
  <div class="card mb-3">
    <div class="card-header">
	
      <i class="fa fa-table"></i> Scale Details 
<a onclick="scale_head()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a>
	  </div>
    <div class="card-body">
	 <form method="POST">
		   <div class="form-group row">
			<label for="Scale" class="col-sm-2 col-form-label">Scale Name</label>
			<div class="col-sm-10">
			  <input type="text"  class="form-control" id="scale_name" name="scale_name" value="<?php echo $res[1]; ?>">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="Date" class="col-sm-2 col-form-label">Date</label>
			<div class="col-sm-10">
			  <input type="date" class="form-control" id="from_date" name="from_date" value="<?php echo $res[2]; ?>">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="basicpay" class="col-sm-2 col-form-label">Basic Pay</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="basic_pay" name="basic_pay" value="<?php echo $res[3]; ?>">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="spl_pay" class="col-sm-2 col-form-label">Special Pay</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="spl_pay" name="spl_pay" value="<?php echo $res[4]; ?>">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="grade_pay" class="col-sm-2 col-form-label">Grade Pay</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="grade_pay" name="grade_pay" value="<?php echo $res[5]; ?>">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="da" class="col-sm-2 col-form-label">Da</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="da" name="da" value="<?php echo $res[6]; ?>">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="hra" class="col-sm-2 col-form-label">Hra</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="hra" name="hra" value="<?php echo $res[7]; ?>">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="cca" class="col-sm-2 col-form-label">Cca</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="cca" name="cca" value="<?php echo $res[8]; ?>">
			</div>
		  </div><div class="form-group row">
			<label for="bonus" class="col-sm-2 col-form-label">Bonus</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="bonus" name="bonus" value="<?php echo $res[9]; ?>">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="Add_Allowance" class="col-sm-2 col-form-label">Additional Allowance</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="addition_allowance" name="addition_allowance" value="<?php echo $res[10]; ?>">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="Others" class="col-sm-2 col-form-label">Others</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="others" name="others" value="<?php echo $res[11]; ?>">
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
		 
		  <!--div class="form-group row">
			<div class="col-sm-10">
			  <input type="hidden"  class="form-control" id="grade_pay" name="grade_pay" value="<?php echo $res[0]; ?>" placeholder="Grade Pay Amount">
			</div>
		  </div-->
		  
		  <div class="form-group row">
			<div class="col-sm-10"></div>
			<div class="col-sm-2">
			<input type="hidden" name="sname" id="sid" value="<?php echo $res[0];?>">
			  <input type="button" class="btn btn-primary btn-md" id="<?php echo $ids; ?>" onclick="scale_head_update(this.id)" value="Update">
			</div>
		  </div>
	</form>
    </div>
  </div>
</div>
</div>
<script>
function scale_head()
{
  $.ajax({
    type:"POST",
    url:"/Recruitment/Recruitment/payroll/scale_details.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function scale_head_update(v)
{
	var id=v;
	alert(id);
	 var data = $('form').serialize();
	$.ajax({
		type:'GET',
		data:"id="+id, data,
		url:'/Recruitment/Recruitment/payroll/scale_details_update.php',
		success:function(data)
		{
			 if(data==0)
			{
				alert("Updated Scale Master");
				scale_head();
			}
			else
			{
				alert("Not Updated Scale Master");
				scale_head();
			} 	
		}       
	}); 
}
</script>
