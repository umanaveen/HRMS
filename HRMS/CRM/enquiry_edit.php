<?php
require '../../connect.php';
include("../../user.php");
 $id=$_REQUEST['id'];

$stmt = $con->prepare("SELECT enquiry.id as enquiry_id,enquiry.call_type as callid,calls_master.name as cname,enquiry.status as enquiry_status,enquiry.mail as enquiry_mailid,enquiry.*,calls_master.*,z_department_master.*,candidate_form_details.*  FROM `enquiry`
	   left JOIN calls_master ON enquiry.Call_type=calls_master.id
	  left join z_department_master ON enquiry.Department=z_department_master.id
	  left JOIN candidate_form_details ON enquiry.employee=candidate_form_details.id
where enquiry.id='$id'"); 

$stmt->execute(); 
$row_fetch = $stmt->fetch();


?>
<div class="card card-info">
              <div class="card-header">
                
				              <center><h3 class="card-title"><b>Edit Enquiry</b></h3></center>
		<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
              </div>

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
		<td>Call_type :</td>
		<td colspan="2">
		<select class="form-control" id="Call_type" name="Call_type" >
		<option value="<?php echo $row_fetch['callid'];?>"><?php echo $row_fetch['cname'];?></option>
		
		<?php $stmt = $con->query("SELECT * FROM calls_master ");
		while ($dept = $stmt->fetch()) {?>
		<option value="<?php echo $dept['id']; ?>"> <?php echo $dept['name']; ?> </option>
		<?php } ?>
		</select></td>
        
		
		
        </tr>
        <input type="hidden" class="form-control"  id="get_id" name="get_id" value="<?php echo $id; ?>">
        
       <tr>
        <td>Date</td>
        <td colspan="5"><input type="date" class="form-control" placeholder="Select Date" id="date" name="date" value="<?php echo $row_fetch['date']; ?>"></td>
        </tr>
		<?php if ($row_fetch['Client_type']==1){
			?>
          <tr>
		<td>Client Type:</td>
		<td colspan="5">
		<select class="form-control" id="Client_type" name="Client_type" >
		
		<option value="1">Existing</option>
		<option value="2">New</option>
		
		</select></td>
        </tr>
		<?php } else { ?>
		 <tr>
		<td>Client Type:</td>
		<td colspan="5">
		<select class="form-control" id="Client_type" name="Client_type" >
		
		
		<option value="2">New</option>
		<option value="1">Existing</option>
		</select></td>
        </tr>
		<?php } ?>
		
        <tr>
        <td>Company Name</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Company" id="Company_name" name="Company_name" value="<?php echo $row_fetch['Company_name']; ?>"></td>
        </tr>
        <tr>
       <td>Location</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Location" id="Location" name="Location" value="<?php echo $row_fetch['Location']; ?>"></td>
        </tr>
        <tr>
        <td>Address</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Address" id="Address" name="Address" value="<?php echo $row_fetch['Address']; ?>"></td>
        </tr>
        
         <tr>
        <td>contact person name</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Client Name" id="Client" name="Client" value="<?php echo $row_fetch['Client']; ?>"></td>
        </tr>
		 <tr>
        <td>Designation</td>
        <td colspan="5">
			<input type="text"  id="Designation" name="Designation" class="form-control"  placeholder="Enter Designation" required="true" value="<?php echo $row_fetch['Designation']; ?>">
		</td>
        </tr>
		 <tr>
        <td>Contact Number</td>
        <td colspan="5">
			<input type="text"  id="Number" name="Number" class="form-control"  placeholder="Enter Number" required="true" value="<?php echo $row_fetch['Mobile']; ?>">
		</td>
        </tr>
		<tr>
        <td>Mail_id</td>
        <td colspan="5">
			<input type="mail"  id="mail" name="mail" class="form-control"  placeholder="Enter mail" required="true" value="<?php echo $row_fetch['enquiry_mailid']; ?>">
		</td>
        </tr>
		<?php if($row_fetch['Product']==1){?>
		<tr>
        <td>Product/Service</td>
        <td colspan="5">
		<select name="Product" class="form-control" id="Product" onchange="productstatus(this.value)">
		
		<option value="1">Product</option>
		<option value="1">Product</option>
		<option value="2">Services</option>
		<option value="3">Solution</option>
		</select>
		</td>
        </tr>
		
		<?php } else if($row_fetch['Product']==2) {?>
		<tr>
        <td>Product/Service</td>
        <td colspan="5">
		<select name="Product" class="form-control" id="Product" onchange="productstatus(this.value)">
		
		<option value="2">Services</option>
		<option value="1">Product</option>
		<option value="2">Services</option>
		<option value="3">Solution</option>
		</select>
		</td>
        </tr>
		
		<?php } else if($row_fetch['Product']==2) { ?>
		<tr>
        <td>Product/Service</td>
        <td colspan="5">
		<select name="Product" class="form-control" id="Product" onchange="productstatus(this.value)">
		
		<option value="2">Services</option>
		<option value="1">Product</option>
		<option value="2">Services</option>
		<option value="3">Solution</option>
		</select>
		</td>
        </tr>
		
		<?php } 
		else
		{
			?>
			<tr>
        <td>Product/Service</td>
        <td colspan="5">
		<select name="Product" class="form-control" id="Product" onchange="productstatus(this.value)">
		
		<option value="">Select Product/Service</option>
		<option value="1">Product</option>
		<option value="2">Services</option>
		<option value="3">Solution</option>
		</select>
		</td>
        </tr>
			<?php
		}
		?>
		<?php 
		
		if($row_fetch['list'] =="")
		{
			echo "hiii". $row_fetch['list'];?>
		<tr>
        <td></td>
        <td colspan="5">
		 <select class="form-control" name="services" id="services">
					
		</select>
		
		</td>
        </tr>
		<?php 
		}
		else
		{
			$lis=$row_fetch['list'] ;
			$sql1=$con->query("SELECT * FROM `product/services` where id='$lis'");
			$fets=$sql1->fetch();
			$prod=$fets["mapping_id"]
			?>
			<tr>
        <td></td>
        <td colspan="5">
		 <select class="form-control" name="services" id="services">
		<option value="<?php echo $fets["id"]; ?>"><?php echo $fets["name"]; ?></option>
		<?php
		$sql=$con->query("SELECT * FROM `product/services` where mapping_id='$prod'");

   while($row = $sql->fetch(PDO::FETCH_ASSOC))
{
?>

<option value="<?php echo $row["id"];?>"><?php echo $row["name"];?></option>
<?php
} 
?>
		</select>
		
		</td>
        </tr>
			<?php
			
		}
		?>
		<tr>
        <td>Feedback</td>
        <td colspan="5">
			<input type="mail"  id="Feedback" name="Feedback" class="form-control"  placeholder="Enter Feedback" required="true" value="<?php echo $row_fetch['Feedback']; ?>">
			
		</td>
        </tr>
		<tr>
        <td>Follup Date</td>
        <td colspan="5">
			<input type="date"  id="Follup" name="Follup" class="form-control"  placeholder="Enter Follup" required="true" value="<?php echo $row_fetch['Follup']; ?>">
		</td>
        </tr>
		 	
		 <tr>
		<td>Department :</td>
		<td colspan="5">
		<select class="form-control" id="Department" name="Department" >
		<option value="<?php echo $row_fetch['id'];?>"><?php echo $row_fetch['dept_name'];?></option>
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
				<option value="<?php echo $row_fetch['id'];?>"><?php echo $row_fetch['first_name'];?></option>
		<?php $stmt = $con->query("SELECT * FROM candidate_form_details ");
		while ($row = $stmt->fetch()) {?>
		<option value="<?php echo $row['id']; ?>"> <?php echo $row['first_name']; ?> </option>
		<?php } ?>
					 
					
</select></td>
        </tr>
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="update_enqurie()" value="save"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>

    <script>
    function insert_enqurie()
    {
    var id=0;
	alert(id);
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
	
		$(document).ready(function() 
		{
$('#Department').on('change', function() {

var department_id = this.value;
alert(department_id);
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

function productstatus(value)
{
if(value=='3')
{
document.getElementById('services').style.visibility = "hidden";

}
else
{
document.getElementById('services').style.visibility = "visible";
}
}


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

 function update_enqurie()
    {
    var id=$('#get_id').val();
	//alert(id);
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data:"id="+id, data,
	url:"HRMS/CRM/enquiry_update.php",
    success:function(data)
    {
      if(data==1)
      { 
        alert('Not updated');
      
      }
      else
      {
        alert("Update Successfully");
		enquiry()
      }
      
    }       
    });
    }
 </script>
