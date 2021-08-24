<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
?>
<!--div class="container-fluid"-->
<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">New Role</font></h3>
			<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
				
              </div>


<form method="POST" action="">
<table class="table table-bordered">

       <tr>
        <td><center><img src="/HRMS/HRMS/Recruitment/image/userlog/bluebase.png"  style="width:300px;height:150px;"></center></td>
        <td colspan="5"><center><h1><b>Bluebase Software services Pvt Ltd</b></h1></center></td>
        </tr>
       <tr>
		<td>Employee:</td>
		<td colspan="5">
		<select class="form-control" id="Employee" name="Employee" >
		<option value="">Choose Type</option>
		<?php $stmt = $con->query("SELECT * FROM staff_master");
		while ($row = $stmt->fetch()) {?>
		<option value="<?php echo $row['candid_id']; ?>"> <?php echo $row['emp_name']; ?> </option>
		<?php } ?>
		</select></td>
        </tr>
     
	 <tr>
		<td>Role  Code:</td>
		<td colspan="5">
		<select class="form-control" id="code" name="code" >
		<option value="">Choose Type</option>
		<?php $stmt = $con->query("SELECT * FROM z_role_master");
		while ($row = $stmt->fetch()) {?>
		<option value="<?php echo $row['id']; ?>"> <?php echo $row['code']; ?>--<?php echo $row['role_name']; ?> </option>
		<?php } ?>
		</select></td>
        </tr>
        
       
         
		<input type="hidden" class="form-control" id="role_code" name="role_code" readonly>
		
        
        
              
	
        
  <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="insert_role()" value="save"></td>
        </tr>
        </table>
</form>
</div>
<script>
		function back()
    {
 user_role()
  }
  </script>
  <script>
  $(document).ready(function() {
$('#code').on('change', function() {
var code = this.value;
//alert(code);
$.ajax({
url: "HRMS/user_role/find_role.php",
type: "get",
data: {
code: code
},
cache: false,
success: function(data){
	//alert(data);
var split=data.split("=");
//alert(split[0]);

$('#role_code').val(split[0]);

//alert(split[1]);
}
});

});

});
    function insert_role()
    {
    var id=0;
    var data = $('form').serialize();
	//alert(data);
    $.ajax({
    type:'GET',
    data:"id="+id, data,
	url:"HRMS/user_role/role_insert.php",
    success:function(data)
    {
      if(data!='')
      { 
        alert('Entry Successfully');
     user_role()
      }
      else
      {
        alert("No Data choose");
		 user_role()
      }
      
    }       
    });
    }
	
	
    </script>
