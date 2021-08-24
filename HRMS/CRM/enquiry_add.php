<?php
require '../../connect.php';
?>


              <div class="card card-info">
              <div class="card-header">
                
				              <center><h3 class="card-title"><b>New Enquiry</b></h3></center>
		<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
              </div>
			 
    <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
        <tr>
        <td><center><img src="/HRMS/HRMS/Recruitment/image/userlog/bluebase.png"  style="width:300px;height:150px;"></center></td>
        <td colspan="5"><center><h1><b>Bluebase Software services Pvt Ltd</b></h1></center></td>
        </tr>
      
       
		
        
		
		  <tr>
		<td>Client Type</td>
		<td colspan="5">
		<select class="form-control" id="Client_type" name="Client_type" onchange="clientstatus(this.value)">
		<option value="">Choose Type</option>
		<option value="1">Existing</option>
		<option value="2">New</option>
		
		</select></td>
        </tr>
        
       <tr>
		<td>Call type</td>
		<td colspan="5">
		<select class="form-control" id="Call_type" name="Call_type" onchange="get_consultant(this.value)">
		<option value="">Choose Type</option>
		<?php $stmt = $con->query("SELECT * FROM calls_master");
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
        <td>Client</td>
        <td colspan="5">
		 <input type="text" class="form-control"  list="client_name" autocomplete="off" id="Company_name" name="Company_name" placeholder="Enter Clients">
		 <datalist id="client_name">
        <?php 
		$query = $con->query("SELECT * FROM client_master");
		while ($row_fetch = $query->fetch()) {?>
		
		<option value="<?php echo $row_fetch['org_name']; ?>"> <?php echo $row_fetch['org_name']; ?> </option>
        <?php } ?>
    </datalist>
		
        </tr>
		 <tr>
        <td>Address</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Address" id="Address" name="Address" ></td>
        </tr>
        
        <tr>
       <td>City</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Location" id="Location" name="Location" ></td>
        </tr>
       
         <tr>
        <td>Client name</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Client Name" id="Client" name="Client" id="Client"></td>
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
        <td>Service</td>
        <td colspan="5">
			<input type="mail"  id="Product" name="Product" class="form-control"  placeholder="Enter Service" required="true">
		</td>
        </tr>
		
	
		<tr>
        <td>Feedback</td>
        <td colspan="5">
			<input type="text"  id="Feedback" name="Feedback" class="form-control"  placeholder="Enter Feedback" required="true">
		</td>
        </tr>
		<tr>
        <td>Followup Date</td>
        <td colspan="5">
			<input type="date"  id="Follup" name="Follup" class="form-control"  placeholder="Enter Follup" required="true">
		</td>
        </tr>
		
		
		
		 
		 <tr id="dep1">
		<td>Assign To Department :</td>
		<td colspan="5">
		<select class="form-control" id="Department" name="Department" >
		<option value="">Choose Type</option>
		<?php $stmt = $con->query("SELECT * FROM z_department_master");
		while ($row = $stmt->fetch()) {?>
		<option value="<?php echo $row['id']; ?>"> <?php echo $row['dept_name']; ?> </option>
		<?php } ?>
		</select></td>
        </tr>
		<tr id="emp1">
		<td>Assign To Employee :</td>
		<td colspan="5">
		 <select class="form-control" name="employee" id="employee" required>
				
					 
					
</select></td>
        </tr>
		 <tr id="dep2">
        <td>Account Manager Department</td>
        <td colspan="5">
		<input type="hidden"  id="Departments_id" name="Departments_id" class="form-control"  readonly required="true">
			<input type="text"  id="Departments" name="Departments" class="form-control"  readonly required="true">
		</td>
        </tr>
		 <tr id="emp2">
        <td>Accout Manager</td>
        <td colspan="5">
			<input type="hidden"  id="employees_id" name="employees_id" class="form-control"  readonly required="true">
			<input type="text"  id="employees" name="employees" class="form-control"  readonly required="true">
		</td>
        </tr>
		<tr>
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="insert_enqurie()" value="save"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>

    <script>
	
	
$(document).ready(function() {
$('#Company_name').on('change', function() {

 var Client_type=$('#Client_type').val();
//alert(Client_type);

if(Client_type==1){
var Company_name = this.value;
//alert(Company_name);
$.ajax({
url: "HRMS/CRM/find_client.php",
type: "get",
data: {
Company_name: Company_name
},
cache: false,
success: function(data){
	//alert(data);
var split=data.split("=");
//alert(split[0]);

$('#Location').val(split[0]);
$('#Address').val(split[1]);
$('#Client').val(split[2]);
$('#Designation').val(split[3]);
$('#Number').val(split[4]);
$('#mail').val(split[5]);
$('#Departments').val(split[6]);
$('#employees').val(split[7]);
$('#Departments_id').val(split[8]);
$('#employees_id').val(split[9]);
//alert(split[1]);
}
});
}
});

});

    function insert_enqurie()
    {
    var id=0;
	//alert(id);
	
    var data = $('form').serialize();
//alert(data);
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
type: "GET",
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
$(document).ready(function() {
$('#Product').on('change', function() {

var Product = this.value;
//alert(Product);
$.ajax({
url: "HRMS/CRM/find_services.php",
type: "POST",
data: {
Product: Product
},
cache: false,
success: function(result){
$("#services").html(result);

}
});
});
});   
function back()
	{
		enquiry()
	}
function clientstatus(value)
{
if(value=='1')
{
document.getElementById('dep1').style.visibility = "hidden";
document.getElementById('emp1').style.visibility = "hidden";
document.getElementById('dep2').style.visibility = "visible";
document.getElementById('emp2').style.visibility = "visible";

}
else
{
document.getElementById('dep1').style.visibility = "visible";
document.getElementById('emp1').style.visibility = "visible";
document.getElementById('dep2').style.visibility = "hidden";
document.getElementById('emp2').style.visibility = "hidden";

}
}
 
document.getElementById("cname").style.display = "none";
function get_consultant(value)
{
	//alert(value);
 if(value=='1')
{

document.getElementById("cname").style.display = "none";
}
else if(value=='2')
{

document.getElementById("cname").style.display = "none";
}
else if(value=='3')
{

document.getElementById("cname").style.display = "none";
}
else if(value=='4')
{
document.getElementById("cname").style.display = "block";

}
}
 $(document).ready(function() {
$('#code').on('change', function() {
var code = this.value;
//alert(code);
 $.ajax({
url: "HRMS/resource/resource_form/find_consultant.php",

type: "get",
data: {
code: code
},
cache: false,
success: function(data){
	//alert(data);
var split=data.split("=");
//alert(split[0]);

$('#consl_name').val(split[0]);

//alert(split[1]);
}
});

});

});
   </script>
