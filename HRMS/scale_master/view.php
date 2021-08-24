<?php
require '../../connect.php';
$ids=$_REQUEST['ids'];
 $edit_id=$con->query("select * from master_scale_master where id='$ids'");
$res = $edit_id->fetch();
?>

<div class="content-wrapper" id="main_content">
<div class="container-fluid">
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-table"></i> Scale Master
	  <input type="button" style="float:right;" class="btn btn-warning" name="back" value="BACK" onclick="scale_master()">
	  </div>
    <div class="card-body">
	 <form method="POST">
		  <div class="form-group row">
			<label for="Scale" class="col-sm-2 col-form-label">Scale Name</label>
			<div class="col-sm-10">
			  <input type="hidden"  class="form-control" id="ids" name="ids" value="<?php echo $ids; ?>" placeholder="Scale Name">
			  <input type="text"  class="form-control" id="scale" name="scale" value="<?php echo $res['scale_name']; ?>" placeholder="Scale Name" readonly>
			</div>
		  </div>
		  <div class="form-group row">
			<label for="Date" class="col-sm-2 col-form-label">Date</label>
			<div class="col-sm-10">
			  <input type="date" class="form-control" id="from_date" name="from_date" value="<?php echo $res['from_date']; ?>" placeholder="Date" readonly>
			</div>
		  </div>
		  <div class="form-group row">
			<label for="basicpay" class="col-sm-2 col-form-label">Basic Pay</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="basic_pay" name="basic_pay" value="<?php echo $res['basic_pay']; ?>" placeholder="Basic Pay Amount" readonly>
			</div>
		  </div>
		  <div class="form-group row">
			<label for="spl_pay" class="col-sm-2 col-form-label">Special Pay</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="spl_pay" name="spl_pay" value="<?php echo $res['spl_pay']; ?>"placeholder="Special Pay Amount" readonly>
			</div>
		  </div>
		  <div class="form-group row">
			<label for="grade_pay" class="col-sm-2 col-form-label">Grade Pay</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="grade_pay" name="grade_pay" value="<?php echo $res['grade_pay']; ?>" placeholder="Grade Pay Amount" readonly>
			</div>
		  </div>
		  <div class="form-group row">
			<label for="da" class="col-sm-2 col-form-label">Da</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="da" name="da" value="<?php echo $res['da']; ?>" placeholder="DA Amount" readonly>
			</div>
		  </div>
		  <div class="form-group row">
			<label for="hra" class="col-sm-2 col-form-label">Hra</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="hra" name="hra" value="<?php echo $res['hra']; ?>" placeholder="Hra Amount" readonly>
			</div>
		  </div>
		  <div class="form-group row">
			<label for="cca" class="col-sm-2 col-form-label">Cca</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="cca" name="cca" value="<?php echo $res['cca']; ?>" placeholder="Cca Amount" readonly>
			</div>
		  </div><div class="form-group row">
			<label for="bonus" class="col-sm-2 col-form-label">Bonus</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="bonus" name="bonus" value="<?php echo $res['bonus']; ?>" placeholder="Bonus Amount" readonly>
			</div>
		  </div>
		  <div class="form-group row">
			<label for="Add_Allowance" class="col-sm-2 col-form-label">Additional Allowance</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="add_allowance" name="add_allowance" value="<?php echo $res['addition_allowance']; ?>" placeholder="Additional Allowance" readonly>
			</div>
		  </div>
		  <div class="form-group row">
			<label for="Others" class="col-sm-2 col-form-label">Others</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="others" name="others" value="<?php echo $res['others']; ?>" placeholder="Other Amount" readonly>
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
</script>

