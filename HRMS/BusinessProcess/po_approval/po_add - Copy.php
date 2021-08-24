<?php
require '../../../connect.php';
include("../../../user.php");
$id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT enquiry.id as enquiry_id,enquiry.status as enquiry_status,enquiry.mail as enquiry_mailid,enquiry.*,calls_master.*,z_department_master.*,candidate_form_details.*  FROM `enquiry`
	   INNER JOIN calls_master ON enquiry.Call_type=calls_master.id
	  INNER join z_department_master ON enquiry.Department=z_department_master.id
	  INNER JOIN candidate_form_details ON enquiry.employee=candidate_form_details.id
where enquiry.id='$id'"); 

$stmt->execute(); 
$row = $stmt->fetch();
?>
 <div class="card card-info">
              <div class="card-header">  
              <center><h3 class="card-title"><b>Enquiry Details </b></h3></center>
			<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
              </div>
			  <br>
			  <br>
			  <br>
              <!-- /.card-header -->
              <!-- form start -->
  <form name="add_name" id="add_name" enctype="multipart/form-data">  
         
                <div class="card-body">
				 
				  
				   <div class="form-group row">
                    <label for="inputdob" class="col-sm-2 col-form-label">Date</label>
                    <div class="col-sm-4">
					  <input type="hidden" class="form-control" name="get_id" id="get_id" value="<?php echo  $id;?>"
                      <input type="text" class="form-control" name="date" id="date" value="<?php echo  $row['date'];?>"readonly>
                    </div>
                  </div>
				    
				  <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">Company Name</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="Company_Name" id="Company_Name" value="<?php echo  $row['Company_name'];?>"readonly>
                    </div>
                  </div>
				
				
				  <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">Location</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="Location" id="Location" value="<?php echo  $row['Location'];?>"readonly>
                    </div>
                  </div>
				  
				    <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="Address" id="Address" value="<?php echo  $row['Address'];?>"readonly>
                    </div>
                  </div>
				  
			
		   <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">Client name</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="Client_name" id="Client_name" value="<?php echo  $row['Client'];?>"readonly>
                    </div>
                  </div>
				  
				     <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">Contact Number</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="Contact_Number" id="Contact_Number" value="<?php echo  $row['Mobile'];?>"readonly>
                    </div>
                  </div>
			
	   <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">Designation</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="Designation" id="Designation" value="<?php echo  $row['Designation'];?>"readonly>
                    </div>
                  </div>
	   <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">Mail_id</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="Mail_id" id="Mail_id" value="<?php echo  $row['enquiry_mailid'];?>"readonly>
                    </div>
                  </div>
	   <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">Service</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="Product_Service" id="Product_Service" value="<?php echo  $row['Product'];?>"readonly>
                    </div>
                  </div>


<div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">Po Upload</label>
  <div class="col-sm-4">
                                    <input type="file" name="uploadfile"  id="uploadfile" value=""/>
									
                              </div>
                  </div>

				  

								  
                </div>
				<input type="submit" name="submit" id="submit" style="float: right;" class="btn btn-info" value="Submit" /> 
				
              </form>
			   
			
			  
            </div>
			
			<script>

	function back()
	{
		enquiry()
	}
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
	//alert(id);
 var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data:"id="+id,data,
	
    url:'HRMS/CRM/change_status.php',
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
 $(document).ready(function(){  
      
	  $("form[name='add_name']").on("submit", function(ev) {
		 ev.preventDefault();
var formData = new FormData(this);	  
           $.ajax({  
               url:"HRMS/BusinessProcess/po_approval/po_submit.php",
                method:"POST",  
                data:formData, 
				cache: false,
				contentType: false,
    processData: false,
                success:function(data)  
                {  
                    // alert(data);  
					alert('Products Added Successfully');
                     $('#add_name')[0].reset();  
                }  
           });  
      });  
 });  
 </script>