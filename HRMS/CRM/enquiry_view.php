<?php
require '../../connect.php';
include("../../user.php");
$id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT enquiry.id as enquiry_id,enquiry.status as enquiry_status,enquiry.mail as enquiry_mailid,enquiry.*,calls_master.*,z_department_master.*,candidate_form_details.*  FROM `enquiry`
	   left JOIN calls_master ON enquiry.Call_type=calls_master.id
	  left join z_department_master ON enquiry.Department=z_department_master.id
	  left JOIN candidate_form_details ON enquiry.employee=candidate_form_details.id
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
<form role="form" name="" action="" method="post" enctype="multipart/type">
         
                <div class="card-body">
				  <div class="form-group row">
                    <label for="inputname" class="col-sm-2 col-form-label">Call Type</label>
                    <div class="col-sm-4">
					 <input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $row['enquiry_id']; ?>">
                      <input type="text" class="form-control" name="name" id="name" value="<?php echo  $row['name'];?>"readonly>
                  </div>
				  </div>
				  
				   <div class="form-group row">
                    <label for="inputdob" class="col-sm-2 col-form-label">Date</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="date" id="date" value="<?php echo  $row['date'];?>"readonly>
                    </div>
                  </div>
				    <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Client Type</label>
                    <div class="col-sm-4">
					<?php if($row['Client_type']==1){
						?>
                      <input type="text" class="form-control" name="Client_Type" id="Client_type" value="Existing"readonly>
					<?php } else {
?>
						  <input type="text" class="form-control" name="Client_Type" id="Client_type" value="New" readonly>
						  <?php
					}
					?>
						
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
                    <label for="inputnumber" class="col-sm-2 col-form-label">Feedback</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="Feedback" id="Feedback" value="<?php echo  $row['Feedback'];?>"readonly>
                    </div>
                  </div>
<div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">Followup Date</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="Follup" id="Follup" value="<?php echo  $row['Follup'];?>"readonly>
                    </div>
                  </div>

<div class="form-group row">

                    <div class="col-sm-4">
					
		  
			  <input type="hidden" class="form-control" name="companys" id="companys" value="Bluebase Software services Pvt Ltd"  readonly>
			 
                     
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
				  <br>
				  <br>
				  <table class="table table-bordered">
<h3><center>Feedback Entry Details</center></h3>
<tbody>

<?php

$sql=$con->query("SELECT * FROM  feedback_enquiry_crm where enquiry_id='$id'");


$cnt=1;
while($rows = $sql->fetch(PDO::FETCH_ASSOC))

{
	
		?>
<tr>
<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $rows['enquiry_id']; ?>">
<td>Feedback</td>
<td><input type="text" class="form-control" id="feedback_1" name="feedbacks[]" value="<?php echo  $rows['Feedback']; ?>" readonly></td>



<td>Feedback Date:</td><td colspan="1"><input type="text" class="form-control" id="date_1" name="dates[]" value="<?php echo  $rows['feedback_date']; ?>" readonly></td>

</tr>
<?php 
$cnt=$cnt+1;
 }?>
 </tbody>
 
      </table>
	  <br>
	  <br>
	  <?php if($row['enquiry_status']==1){
				 
			 ?>
				  <table class="table table-bordered" id="new_tab">
    <tr>
   <h3><center>Feedback Entry </center></h3>
    </tr>
    <tr>
      <th>#</th>
      <th>Feedback</th>
      <th>Feedback Followup Date</th>
     
    </tr>
    
    
    <tr>
      <td><input type="checkbox" class="chk" name="chk[]" id="chk_1" value="1" style="width:15px;height:20px;"/></td>
    
      <td><input type="text" class="form-control" id="feedback_1" name="feedback[]"></td>
      <td><input type="date" class="form-control" id="date_1" name="date[]"></td>
     
      <td><input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check()" value="Add">
      <input type="button" class="btn btn-danger" id="enquiry_row_remove"  value="Remove">
    </td>
    </tr>
   
     
    </table>
	  <?php } ?>
                </div>
				 <?php if($row['enquiry_status']==1){
				 
			 ?>
              <input type="button" class="btn btn-success" id="save" name="save" onclick="enquiry_accept()" value="Save">
			   <br>
			  <br>
			
			   <input type="button" class="btn btn-primary" id="save" name="save" onclick="change_status()" value="Generate Lead">
			 <?php
			 }
			 ?>
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
	alert(id);
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
	</script>