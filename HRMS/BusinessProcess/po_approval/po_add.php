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
              <center><h3 class="card-title"><b>Po Details </b></h3></center>
			<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
              </div>
			  
             
   <div class="form-group">  
                     <form name="add_name" id="add_name" enctype="multipart/form-data">  
					  
  <div class="card-body">
                                
								<div class="form-group row">
                    <label for="inputdob" class="col-sm-2 col-form-label">Client Company_name</label>
					
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="Company_name" id="Company_name" value="<?php echo  $row['Company_name'];?>"readonly>
                    </div>
                  </div>
                          <div class="form-group row">
                    <label for="inputdob" class="col-sm-2 col-form-label">Client Name</label>
					
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="clinet_name" id="clinet_name" value="<?php echo  $row['Client'];?>"readonly>
                    </div>
                  </div>     
				   <div class="form-group row">
                    <label for="inputdob" class="col-sm-2 col-form-label">Po Upload</label>
					
                    <div class="col-sm-4">
                      <input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $row['enquiry_id']; ?>">
					   <input type="file" name="uploadfile"  value=""/>
                    </div>
                  </div>   
                            </div>
						
                                
                               
                            
								  <input type="submit" name="submit" id="submit" style="float: left;" class="btn btn-info" value="Submit" />  
								
                     </form>  
                </div>  
			   
			
			  
            </div>
			
			
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
					 po_upload()
                }  
           });  
      });  
 });  
 
 function back()
    {
    $.ajax({
    type:"POST",
   url:"HRMS/BusinessProcess/po_approval/po_upload.php",
    success:function(data){
    $("#main_content").html(data);
	
    }
    })
  }
 </script>