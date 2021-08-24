<?php
require ("../../../connect.php");
?>

<div class="container-fluid">	

	<div class="col-lg-12">
        <div  class="card card-primary">
        <div class="card-header">
        <h3 class="card-title"><font size="5">Permission Form</font></h3>
        <a onclick="return back_permission()"  style="float: right;" data-toggle="modal" class="btn btn-dark">Back </a>
        </div>
        </div>
		<div class="row">

            <!-- FORM Panel -->
            <div class="col-md-12">
            <form action="" id="manage-employee">
				<div class="card">
					<!--div class="card-header">
						  Department Form
				  	</div-->
					<div class="card-body">
							<input type="hidden" name="id">
							<div class="form-group">
								<label class="control-label">Employee Type</label>
                                <select name="employee_type" id="employee_type" cols="30" rows="2" class="form-control">
								<option value="">Select</option>
								<option value="1">Onroll Employees</option>
								<option value="2">Apprentices</option>
								<option value="3">Contract Labours</option>
								</select>	
								</div>
					</div>
					<div class="card-body">
							<input type="hidden" name="id">
							<div class="form-group">
								<label class="control-label">Woosu employee Master</label>
                                <select class="form-control" name="emp_code" id="emp_code" cols="30" rows="2" class="form-control">
                                <option value="0">Select Woosu Employee Master</option>
                                <?php
                                     $isql=$con->query("SELECT emp_no FROM woosu_employee_master");			
                                     $i=1;
                                     while($woo_emp_mas = $isql->fetch(PDO::FETCH_ASSOC))			
                                      {
                                ?>
                                <option value="<?php echo $woo_emp_mas['emp_no']; ?>"><?php echo $woo_emp_mas['emp_no']; ?></option>
                                <?php 
                                } 
                                ?>
                                </select>	
                           </div>
					</div>
					<div class="card-body">
							<input type="hidden" name="id">
							<div class="form-group">
								<label class="control-label">Date</label>
								<input type="date" name="permission_date" id="permission_date" cols="30" rows="2" class="form-control">
							</div>
					</div>
					<div class="card-body">
							<input type="hidden" name="id">
							<div class="form-group">
								<label class="control-label">Time1</label>
								<input type="time" name="from_time" id="from_time" cols="30" rows="2" class="form-control">
							</div>
					</div>
					<div class="card-body">
							<input type="hidden" name="id">
							<div class="form-group">
								<label class="control-label">Time2</label>
								<input type="time" name="to_time" id="to_time" cols="30" rows="2" class="form-control">
							</div>
					</div>
					
							
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
							<input type="button" class="btn btn-success" name="save" onclick="insert_permission()" value="save">
								
								<!--button class="btn btn-sm btn-default col-sm-3" type="button" onclick="_reset()"> Cancel</button-->
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
			<!-- FORM Panel -->
		</div>
	</div>	
</div>


<script>
function insert_permission()
    {
    var id=0;
	//alert(id);
    var data = $('form').serialize();
//alert(data);
    $.ajax({
    type:'GET',
    data:"id="+id, data,
    url:"payroll/permission/permission_save.php",	
    success:function(data)
    {      
        alert("Entry Successfully");
		employee_permission()
		          
    }       
    });
    }
	
/* $('#manage-employee').submit(function(e){

		e.preventDefault()
		$.ajax({
			url:'payroll/ajax.php?action=save_employee',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(data){
				 /* if(data==1){
					alert("Data successfully added",'success');
                    back_permission();
				} 
			}
		})
	})
 */


function back_permission()
{
    $.ajax({
    type:"POST",
    url:"payroll/permission/permission.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
</script>