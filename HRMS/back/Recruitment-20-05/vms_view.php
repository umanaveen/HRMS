<?php
require '../../connect.php';
include("../../user.php");
$id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT vms.id as vms_id,vms.status as vms_status,vms.first_name as vms_name,vms.*,z_department_master.*,candidate_form_details. * FROM `vms` INNER JOIN z_department_master ON vms.Department=z_department_master.id INNER JOIN candidate_form_details ON vms.employee = candidate_form_details.id
where vms.id='$id'"); 

$stmt->execute(); 
$row = $stmt->fetch();
?>
 <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">VMS Details </h3>
				<br>
				<br>
			<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
			<br>
			<br>
			
              </div>
              <!-- /.card-header -->
              <!-- form start -->
<form role="form" name="" action="" method="post" enctype="multipart/type">
         
                <div class="card-body">
				  <div class="form-group row">
                    <label for="inputname" class="col-sm-2 col-form-label">Visiting Date </label>
                    <div class="col-sm-4">
					 <input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $id; ?>">
                      <input type="text" class="form-control" name="date" id="date" value="<?php echo  $row['Date'];?>"readonly>
                  </div>
				  </div>
				  
				   <div class="form-group row">
                    <label for="inputdob" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo  $row['first_name'];?>"readonly>
                    </div>
                  </div>
				    <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="email" id="email" value="<?php echo  $row['email'];?>"readonly>
                    </div>
                  </div>
				  <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">Mobile_number</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="mob_num" id="mob_num" value="<?php echo  $row['mob_num'];?>"readonly>
                    </div>
                  </div>
				
				
				  <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">Coming From</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="Coming_from" id="Coming_from" value="<?php echo  $row['Coming_from'];?>"readonly>
                    </div>
                  </div>
				  <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">Assign To Company</label>
                    <div class="col-sm-4">
					
		  
			  <input type="text" class="form-control" name="companys" id="companys" value="Bluebase Software services Pvt Ltd"  readonly>
			 
                     
                    </div>
                  </div>
				    <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">Purpose of Visit</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="Purpose" id="Purpose" value="<?php echo  $row['Purpose'];?>"readonly>
                    </div>
                  </div>
				  <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">Department</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="Department" id="Department" value="<?php echo  $row['dept_name'];?>"readonly>
                    </div>
                  </div>
				  
                  <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">Employee Name</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo  $row['first_name'];?>"readonly>
                    </div>
                  </div>
			
		   <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">Type of Vehicle</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="vehicle" id="vehicle" value="<?php echo  $row['vehicle'];?>"readonly>
                    </div>
                  </div>
				  
				     <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">Vehicle No</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="Vehicle_No" id="Vehicle_No" value="<?php echo  $row['veh_no'];?>"readonly>
                    </div>
                  </div>
			
	   <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">Other/Remarks</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="Remarks" id="Remarks" value="<?php echo  $row['Remarks'];?>"readonly>
                    </div>
                  </div>
	   </div>
				
          
			   <br>
			  <br>
			 
			    <input type="button" class="btn btn-primary" id="save" name="save" onclick="change_status()" value="Submit">
              </form>
			   
			
			  
            </div>
			
			<script>

	
 function enquiry_accept()
    {
    var id=$('#get_id').val();
	//alert(id);
 var data = $('form').serialize();
 
    $.ajax({
    type:'GET',
    data:"id="+id, data,
	
    url:'HRMS/CRM/accept_enquiry.php',
    success:function(data)
    {
      if(data==1)
      { 
        alert('Not');
      }
      else
      {
        alert("Update Successfully");
	 enquiry()
      }
      }           
    });
    }
	
		
 function change_status()
    {
    var id=$('#get_id').val();
	alert(id);
 var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data:"id="+id,data,
	 url:"/HRMS/HRMS/Recruitment/change_status.php",
  
    success:function(data)
    {
      if(data==1)
      { 
        alert('Not');
      }
      else
      {
        alert("Update Successfully");
	lead()
      }
      }           
    });
    }
	
	</script>
	<script>
    function check() // education
    {
    var len=$('#new_tab tr').length;	
    len=len+1; 
    $('#new_tab').append('<tr class="row_'+len+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len+'" value="'+len+'"</td><td><input type="text" class="form-control" id="feedback_'+len+'" name="feedback[]"></td><td><input type="date" class="form-control" id="date_'+len+'" name="date[]"></td></tr>'); 
    }



    $('#enquiry_row_remove').click(function(){
    $('input:checkbox:checked.chk').map(function(){
    var id=$(this).val();
    var le=$('#new_tab tr').length;

    if(le==1)
    {
    alert("You Can't Delete All the Rows");
    }
    else
    {
    $('.row_'+id).remove();
    }

    });
    });
	function back()
    {
   vms()
  }
	</script>