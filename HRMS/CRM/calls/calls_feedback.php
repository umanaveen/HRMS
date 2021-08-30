<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
$id=$_REQUEST['id'];

$sel=$con->query("select * from crm_calls where id='$id'");
$fet=$sel->fetch();
?>
<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header">
<i class="fa fa-table"></i> calls  Add
<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-primary"></i>Back</a>
</div>
<div class="card-body">
<div class="tab-content">

    <div class="active tab-pane" id="for_employment">
    <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
        <tr>
        <td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
        <td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
        </tr>
      
        <tr>
        <td colspan="6"><center><b>Add calls</b></center></td>
        </tr>
		
        
		
     
        <tr>
		<input type="hidden" name="id" id="id" value="<?php echo $id;?>">
        <td>Client Organisation Name</td>
        <td colspan="5"><input type="text" class="form-control" id="client_org" name="client_org" value="<?php echo $fet['client_org'];?>" readonly></td>
        </tr>
		<tr>
        <td>Client Name</td>
        <td colspan="5"><input type="text" class="form-control" id="client_name" name="client_name" value="<?php echo $fet['client_name'];?>"readonly></td>
        </tr>
      <tr>
        <td>Contact Number</td>
        <td colspan="5"><input type="text" class="form-control"id="contact" name="contact"value="<?php echo $fet['contact'];?>"readonly></td>
        </tr>
      <tr>
        <td>Email Id</td>
        <td colspan="5"><input type="text" class="form-control" id="email" name="email"value="<?php echo $fet['email'];?>"readonly></td>
        </tr>
      <tr>
        <td>Website</td>
        <td colspan="5"><input type="text" class="form-control" id="website" name="website"value="<?php echo $fet['website'];?>"readonly></td>
        </tr>
      <tr>
        <td>Address</td>
        <td colspan="5"><input type="text" class="form-control" id="address" name="address"value="<?php echo $fet['address'];?>"readonly></td>
        </tr>
      <tr>
        <td>City</td>
        <td colspan="5"><input type="text" class="form-control" id="city" name="city"value="<?php echo $fet['city'];?>"readonly></td>
        </tr>
      <tr>
        <td>State</td>
        <td colspan="5"><input type="text" class="form-control" id="state" name="state"value="<?php echo $fet['state'];?>"readonly></td>
        </tr>
      <tr>
        <td>Country</td>
        <td colspan="5"><input type="text" class="form-control" id="country" name="country"value="<?php echo $fet['country'];?>"readonly></td>
        </tr>
      
      </table>
	  
	  	  <table class="table table-bordered">
<h3><center>Feedback  Details</center></h3>
<tbody>

<?php

$sql=$con->query("SELECT * FROM  crm_calls_feedback where calls_id='$id'");


$cnt=1;
while($rows = $sql->fetch(PDO::FETCH_ASSOC))

{
	
		?>
<tr>
<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $rows['calls_id']; ?>">
<td>Feedback</td>
<td><input type="text" class="form-control" id="feedback_1" name="feedbacks[]" value="<?php echo  $rows['feedback']; ?>" readonly></td>



<td>Followup Date:</td><td colspan="1"><input type="text" class="form-control" id="date_1" name="dates[]" value="<?php echo  $rows['date']; ?>" readonly></td>

</tr>
<?php 
$cnt=$cnt+1;
 }?>
 </tbody>
 
      </table>
		 <table class="table table-bordered">
		<tr>
        <td>Feedback</td>
        <td colspan="5"><input type="text" class="form-control" id="feedback" name="feedback"></td>
        </tr>
      <tr>
        <td>Followup Date</td>
        <td colspan="5"><input type="date" class="form-control" id="fed_date" name="fed_date"></td>
        </tr>
		<tr>
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="feedback_calls()" value="save"></td>
        <td colspan="6"><input type="button" class="btn btn-primary" name="enquiry" onclick="genrate_enquiry()" value="Genarate Enquiry"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>

			<script>
			 function feedback_calls()
    {
    var id=0;
	//alert(id);
    var data = $('form').serialize();
//alert(data);
    $.ajax({
    type:'GET',
    data:"id="+id, data,
  url:"HRMS/CRM/Calls/calls_feedback_insert.php",
    success:function(data)
    {      
        alert("Entry Successfully");
		 calls()
		          
    }       
    });
    }
	
	 function genrate_enquiry()
    {
    var id=0;
	//alert(id);
    var data = $('form').serialize();
//alert(data);
    $.ajax({
    type:'GET',
    data:"id="+id, data,
  url:"HRMS/CRM/Calls/enquiry_insert.php",
    success:function(data)
    {      
        alert("Entry Successfully");
		 calls()
		          
    }       
    });
    }
	
	
	function back()
	
	{
		 calls()

	}
	</script>