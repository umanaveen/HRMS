<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>

              <div class="card card-info">
              <div class="card-header">
                
				              <center><h3 class="card-title"><b>New Round Mapping</b></h3></center>
		<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
              </div>


<form method="POST" action="HRMS/masters/interview_rounds_mapping/interviewroundsmapping_submit.php">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
<td>Round ID</td>
<td colspan="2"><select class="form-control" name="round_id">
		<option value="0">-- Select Round ID --</option>
		<?php
		$dep_sql=$con->query("SELECT * FROM interview_rounds");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['name']; ?></option>
			<?php
		}
		?>
		</select></td>

</tr>
<tr>
		<td>Department :</td>
		<td colspan="5">
		<select class="form-control" id="Department" name="Department">
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
<td>Status</td>
<td colspan="2">
<select class="form-control" name="status" id="status">
<option value="">Select Status</option>
<option value="1">Active</option>
<option value="0">InActive</option>
</select>
</td>
</tr>
</table>
<input type="button" class="btn btn-success" name="save" onclick="insert_round()" value="save">
</form>
  </div>
  <script>
		function back()
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/masters/interview_rounds_mapping/interview_rounds_mapping.php",
    success:function(data){
 $("#main_content").html(data);
    }
    })
  }

	function insert_round()
    {
    var id=0;
	//alert(id);
    var data = $('form').serialize();
//alert(data);
    $.ajax({
    type:'GET',
    data:"id="+id, data,
    url:'HRMS/masters/interview_rounds_mapping/interviewroundsmapping_submit.php',
    success:function(data)
    {      
        alert("Entry Successfully");
		interview_rounds_mapping()
		          
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
