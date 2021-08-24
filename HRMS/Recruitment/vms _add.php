<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
?>
  <div class="card card-info">
              <div class="card-header">
                
				              <center><h3 class="card-title"><b>New Visitors</b></h3></center>
		<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
              </div>
			  
			  


<form method="POST" action="">
<table class="table table-bordered">
        <tr>
       <td><center><img src="/HRMS/HRMS/Recruitment/image/userlog/bluebase.png"  style="width:300px;height:150px;"></center></td>
        <td colspan="5"><center><h1><b>Bluebase Software services Pvt Ltd</b></h1></center></td>
        </tr>
      
     
		<tr>
        <td>Visiting Date</td>
        <td colspan="5"><input type="date" class="form-control" placeholder="Select Date" id="date" name="date" ></td>
        </tr>
        
       
        <tr>
       <td>Name</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter your name" id="first_name" name="first_name" require></td>
        </tr>
        <tr>
        <td>Email</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Email Address" id="email" name="email" ></td>
        </tr>
        
         <tr>
        <td>Mobile_number</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Mobile Number"  name="mob_num" id="mob_num"></td>
        </tr>
		 <tr>
        <td>Coming From</td>
        <td colspan="5">
			<input type="text"  id="Coming_from" name="Coming_from" class="form-control"  placeholder="Enter Coming_from">
		</td>
        </tr>
			<tr>
		<td>Company:</td>
		<td colspan="5">
		<input type="text"  id="companys" name="companys" value="Bluebase Software services Pvt Ltd" class="form-control"  readonly required="true">
		</td>
        </tr> 
		 <tr>
        <td>Purpose of Visit</td>
        <td colspan="5">
			<input type="text"  id="Purpose" name="Purpose" class="form-control"  placeholder="Enter Purpose of visit">
		</td>
        </tr>
		 <tr>
		<td>Department :</td>
		<td colspan="5">
		<select class="form-control" id="Department" name="Department" onchange="dept()">
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
		 <tr>
        <td>Type of Vehicle</td>
        <td colspan="5">
			<input type="text"  id="vehicle" name="vehicle" class="form-control"  placeholder="Enter vehicle Type">
		</td>
        </tr>
		
		 <tr>
        <td>Vehicle No
</td>
        <td colspan="5">
			<input type="text"  id="Vehicle_No" name="Vehicle_No" class="form-control"  placeholder="Enter Vehicle No">
		</td>
        </tr>
		
		<tr>
        <td>Other/Remarks</td>
        <td colspan="5">
			<input type="text"  id="Remarks" name="Remarks" class="form-control"  placeholder="Enter Remarks">
		</td>
        </tr>
		
	
		
        <td colspan="6">
		<input type="button" class="btn btn-success" name="save" onclick="insert_vms()" value="save"></td>
        </tr>
        </table>
</form>
</div>
<script>
		function back()
    {
   vms()
  }
  </script>
  <script>
    function insert_vms()
    {
    var id=0;
    var data = $('form').serialize();
	//alert(data);
    $.ajax({
    type:'GET',
    data:"id="+id, data,
    url:'/HRMS/HRMS/Recruitment/vms_insert.php',
    success:function(data)
    {
      if(data!='0')
      { 
   alert('Entry Successfully');
       vms()
        
      }
      else
      {
		  alert("No Data choose");
        
      }
      
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
