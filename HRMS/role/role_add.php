<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
?>
<!--div class="container-fluid"-->
<div  class="card card-primary">
 <div class="card-header">
  <h3 class="card-title"><font size="5">Role Add</font></h3>
	<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
  </div>


<form method="POST" action="">
<table class="table table-bordered">

        <tr>
        <td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
        <td colspan="5"><center><b>Bluebase Software Services Private Limited</b></center></td>
        </tr>
      
     
	
        
       
        <tr>
       <td>Role  Code</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Role code" id="code" name="code"></td>
        </tr>
        
        
         <tr>
        <td>Role Name</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Role Name"  name="name" id="name"></td>
        </tr>
		
			
		
		
		
		 
		
	
		
	
		
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="insert_role()" value="save"></td>
        </tr>
        </table>
</form>
</div>
<script>
		function back()
    {
  role()
  }
  </script>
  <script>
    function insert_role()
    {
    var id=0;
    var data = $('form').serialize();
	//alert(data);
    $.ajax({
    type:'GET',
    data:"id="+id, data,
	url:"HRMS/role/role_insert.php",
    success:function(data)
    {
      if(data!='')
      { 
        alert('Entry Successfully');
      role()
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
