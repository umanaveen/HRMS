<?php
require '../../connect.php';
include("../../user.php");
 $id=$_REQUEST['id'];

$stmt = $con->prepare("SELECT * FROM `Enquiry` WHERE id='$id'"); 
$stmt->execute(); 
$row = $stmt->fetch();

?>
<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header">
<i class="fa fa-table"></i> Enquiry  Add
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-plus"></i>Back</a>
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
        <td colspan="6"><center><b>Add Enquiries</b></center></td>
        </tr>
		
        
		
        
        <tr>
		<td>Call_type:</td>
		<td colspan="5">
		<select class="form-control" id="Call_type" name="Call_type" >
		<option value="">Choose Type</option>
		<?php $stmt = $con->query("SELECT * FROM calls_master ");
		while ($row = $stmt->fetch()) {?>
		<option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
		<?php } ?>
		</select></td>
        </tr>
       <tr>
        <td>Date</td>
        <td colspan="5"><input type="date" class="form-control" placeholder="Select Date" id="date" name="date" ></td>
        </tr>
          <tr>
		<td>Client Type:</td>
		<td colspan="5">
		<select class="form-control" id="Client_type" name="Client_type" >
		<option value="">Choose Type</option>
		<option value="1">Existing</option>
		<option value="2">New</option>
		
		</select></td>
        </tr>
        <tr>
        <td>Company Name</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Company" id="Company_name" name="Company_name" ></td>
        </tr>
        <tr>
       <td>Location</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Location" id="Location" name="Location" ></td>
        </tr>
        <tr>
        <td>Address</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Address" id="Address" name="Address" ></td>
        </tr>
        
         <tr>
        <td>Client name</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Client Name" id="Client" name="Client" ></td>
        </tr>
		 <tr>
        <td>Designation</td>
        <td colspan="5">
			<input type="text"  id="Designation" name="Designation" class="form-control"  placeholder="Enter Designation" required="true">
		</td>
        </tr>
		 <tr>
        <td>Contact Number</td>
        <td colspan="5">
			<input type="text"  id="Number" name="Number" class="form-control"  placeholder="Enter Number" required="true">
		</td>
        </tr>
		<tr>
        <td>Mail_id</td>
        <td colspan="5">
			<input type="mail"  id="mail" name="mail" class="form-control"  placeholder="Enter mail" required="true">
		</td>
        </tr>
		<tr>
        <td>Product/Service</td>
        <td colspan="5">
			<input type="text"  id="Product" name="Product" class="form-control"  placeholder="Enter Product" required="true">
		</td>
        </tr>
		<tr>
        <td>Feedback</td>
        <td colspan="5">
			<input type="text"  id="Feedback" name="Feedback" class="form-control"  placeholder="Enter Feedback" required="true">
		</td>
        </tr>
		<tr>
        <td>Follup Date</td>
        <td colspan="5">
			<input type="date"  id="Follup" name="Follup" class="form-control"  placeholder="Enter Follup" required="true">
		</td>
        </tr>
		 <tr>
		<td>Assign To Company :</td>
		<td colspan="5">
		<select class="form-control" id="companys" name="companys" >
		<option value="">Choose Type</option>
		<option value="1">Quadsel Services </option>
		<option value="2">Bluebase Services </option>
		
		</select></td>
        </tr>
		 <tr>
		<td>Department :</td>
		<td colspan="5">
		<select class="form-control" id="Department" name="Department" >
		<option value="">Choose Type</option>
		<?php $stmt = $con->query("SELECT * FROM z_department_master ");
		while ($row = $stmt->fetch()) {?>
		<option value="<?php echo $row['id']; ?>"> <?php echo $row['dept_name']; ?> </option>
		<?php } ?>
		</select></td>
        </tr>
		<tr>
		<td>Employee :</td>
		<td colspan="5">
		 <select class="form-control" name="employee" id="employee" required>
				
					 
					
</select></td>
        </tr>
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="insert_enqurie()" value="save"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>

    <script>
    function insert_enqurie()
    {
    var id=0;
	//alert(id);
    var data = $('form').serialize();
alert(data);
    $.ajax({
    type:'GET',
    data:"id="+id, data,
    url:'HRMS/CRM/insert_enqurie.php',	
    success:function(data)
    {      
        alert("Entry Successfully");
		enquiry()
		          
    }       
    });
    }
	
		$(document).ready(function() {
$('#Department').on('change', function() {

var department_id = this.value;
//alert(department_id);
$.ajax({
url: "HRMS/CRM/find_emp.php",
type: "POST",
data: {
department_id: department_id
},
cache: false,
success: function(result){
$("#employee").html(result);

}
});
});
});
    </script>
