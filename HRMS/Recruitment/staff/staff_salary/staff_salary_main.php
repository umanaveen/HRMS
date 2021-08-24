<?php

require '../../../../connect.php';
require '../../../../user.php';
$staid = $_REQUEST['canid'];


$staffsel=$con->query("select * from staff_master where candid_id='$staid'");
$data1=$staffsel->fetch();
$emp_name=$data1['emp_name'];
$dep_id=$data1['dep_id'];
$div_id=$data1['div_id'];
$design_id=$data1['design_id'];
$scale_master_id=$data1['scale_master_id'];
$payroll_deduction_id=$data1['payroll_deduction_id'];
$salary_amount=$data1['salary_amount'];
?>

<div class="col-12">
			<div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Staff Salary</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" method="POST">
			  <input type="hidden" name="staff_id" id="staff_id" value="<?php echo $staid; ?>">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="emp_name" value="<?php echo $emp_name; ?>" readonly>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Department</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="div_id" value="<?php echo $div_id; ?>" readonly>
                    </div>
                  </div>
				  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Division</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="div_id" value="<?php echo $div_id; ?>" readonly>
                    </div>
                  </div>
				  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Designation</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="design_id" value="<?php echo $design_id; ?>" readonly>
                    </div>
                  </div>
				  
				  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Salary Amount</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="staff_salary_amount" name="staff_salary_amount" value="<?php echo $salary_amount; ?>">
                    </div>
                  </div>
				  
				  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Staff Scale</label>
                    <div class="col-sm-10">
						<div class="form-group">
                        <select class="custom-select" name="staff_scale" onChange="scale_changes(this.value)">
						<?php

						$payroll_scale_sql=$con->query("SELECT id, name, status, created_by, created_on, modified_by, modified_on FROM payroll_scale_master WHERE  id='$scale_master_id'
						union 
						SELECT id, name, status, created_by, created_on, modified_by, modified_on FROM payroll_scale_master WHERE  id not in ('$scale_master_id')");

						$i=1;
						while($payroll_scale_res = $payroll_scale_sql->fetch(PDO::FETCH_ASSOC))
						{

						?>
						<option value="<?php echo $payroll_scale_res['id']; ?>"><?php echo $payroll_scale_res['name']; ?></option>
						<?php

						}
						?>
						<option value="0">--Select Scale--</option>
						<?php

						$payroll_scale_sql=$con->query("SELECT id, name, status, created_by, created_on, modified_by, modified_on FROM payroll_scale_master WHERE  id not in ('$scale_master_id')");

						$i=1;
						while($payroll_scale_res = $payroll_scale_sql->fetch(PDO::FETCH_ASSOC))
						{

						?>
						<option value="<?php echo $payroll_scale_res['id']; ?>"><?php echo $payroll_scale_res['name']; ?></option>
						<?php

						}
						?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
				
	<div class="row">
		<div class="col-md-6">
			<div class="card card-danger">
			<div class="card-header">
			<h3 class="card-title">Earnings</h3>
			</div>
			<div class="card-body" id="earning_body">
			<table class="table table-bordered table-hover">
			<thead>
			<tr><th>#</th><th>Name</th><th>Percentage</th><th>Amount</th></tr>
			</thead>
			<tbody>

			<?php

			$payroll_deduction_sql=$con->query("SELECT id, name, amount, percentage, status, created_by, created_on, modified_by, modified_on FROM payroll_structure where id in (SELECT salary_structure_id FROM payroll_scale_details where payroll_master_id='$scale_master_id')");
			$i=1;
			$grand_tot = 0;
			
			while($payroll_deduction_res = $payroll_deduction_sql->fetch(PDO::FETCH_ASSOC))
			{
				$percentage = $payroll_deduction_res['percentage'];
			?>
			<tr>
			<td><?php echo $payroll_deduction_res['id'] ?></td>
			<td><?php echo $payroll_deduction_res['name'] ?></td>
			<td><?php echo $percentage; ?></td>
			<td style="text-align:right">
			<?php 
			if($percentage > 0)
			{
				$values = ($percentage * $salary_amount/100) ;
				echo $values;
			}
			else
			{ 
				echo $values=0; 
			} 
			?>
			</td>
			</tr>					
			<?php

			$grand_tot =$grand_tot+$values;
			}
			?>
			<tr><td colspan="3">Total</td><td style="text-align:right"><?php echo $grand_tot; ?></td></tr>
			</tbody>
			</table>
			</div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col (left) -->
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Deductions</h3>
              </div>
			<div class="card-body">
			<table class="table table-bordered table-hover">
			<thead>
			<tr><th>#</th><th>Deduction</th><th>Amount</th><th>Percentage</th></tr>
			</thead>
			<tbody>
			
			<?php
			
			if($payroll_deduction_id <>"")
			{
				$payroll_deduction_sql=$con->query("SELECT id, name, from_date, amount, percentage, min_amount, max_amount, status, created_by, created_on, modified_by, modified_on FROM payroll_deduction_master WHERE id in ($payroll_deduction_id)");
				$i=1;
				while($payroll_deduction_res = $payroll_deduction_sql->fetch(PDO::FETCH_ASSOC))
				{

					?>
					<tr>
					<td><?php echo $payroll_deduction_res['id'] ?></td>
					<td><?php echo $payroll_deduction_res['name'] ?></td>
					<td><?php echo $payroll_deduction_res['amount'] ?></td>
					<td><?php echo $payroll_deduction_res['percentage']; ?></td>
					</tr>				
					<?php

				}
			}
			else
			{
				$payroll_deduction_sql=$con->query("SELECT id, name, from_date, amount, percentage, min_amount, max_amount, status, created_by, created_on, modified_by, modified_on FROM payroll_deduction_master");
				$i=1;
				while($payroll_deduction_res = $payroll_deduction_sql->fetch(PDO::FETCH_ASSOC))
				{

					?>
					<tr>
					<td><?php echo $payroll_deduction_res['id'] ?></td>
					<td><?php echo $payroll_deduction_res['name'] ?></td>
					<td><?php echo $payroll_deduction_res['amount'] ?></td>
					<td><?php echo $payroll_deduction_res['percentage']; ?></td>
					</tr>				
					<?php

				}
			}
			?>
				
			</tbody>
			</table>

			</div>
                <!-- /.form group -->
              </div>
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col (right) -->
        </div>
				
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="reset" class="btn btn-default float-right">Reset</button>
				  <input type="button" name="staff_salar_save" value="Save" onclick="staff_salary_save()" class="btn btn-info">
                </div>
                <!-- /.card-footer -->
              </form>
            </div>

</div>
<script>
function scale_changes(v)
{
	var salary_amount = document.getElementById("staff_salary_amount").value;
	$.ajax({
		type:"GET",
		url:"HRMS/Recruitment/staff/staff_salary/staff_earnings_view.php?earning_id="+v+"&salary_amount="+salary_amount,
		success:function(data)
		{
			$('#earning_body').html(data);
		}
	}); 
}
</script>
<script>
 function staff_salary_save()
{
	var id=$('#staff_id').val;
	var data = $('form').serialize();
	$.ajax({
	type:'GET',
	data:"id="+id, data,
	  url:"/HRMS/HRMS/Recruitment/staff/staff_salary/staff_salary_update.php",
		success:function(data)
		{
			if(data==1)
			{
				alert("Created Deduction Master");
				staff_list();
			}       
			else
			{
				alert("Not Created Deduction Master");
			}	
		}
	}); 
}
</script>
