<?php
require '../../../../connect.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("select * from project where id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();
//$sid=$row['emp_name'];
//$pid=$row['dep_id'];
?>
<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> PROJECT DETAILS EDIT
<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
</div>
<div class="card-body" id="printableArea">
<form role="form" name="" action="HRMS/Recruitment/project_management/project/update_project.php" method="post" enctype="multipart/type">

<table class="table table-bordered">
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
 <td>Client:</td>
	 <td colspan="2">
		<select class="form-control" name="client" id="client">
		<option value="<?php echo $row['id'];?>"><?php echo $row['client'];?></option>
		<?php
		$sql=$con->query("SELECT * FROM client_master");
		$i=1;
		while($cmp = $sql->fetch(PDO::FETCH_ASSOC))
		{
		  ?>
		  <option value="<?php echo $cmp['id'];?>"><?php echo $cmp['client_name'];?></option>
		  <?php
		}
		  ?>
	</select>
	 </td>
</tr>
<tr>
<td>Project Name:</td>
<td colspan="2">
<input type="text" class="form-control" id="project_name" name="project_name" value="<?php echo $row['project_name']; ?>"></td>

</tr>
 <table class="table table-bordered" id="new_tab">

<tr> 
     <tr>
      <td>Department Name:</td>
	 <td colspan="2">
		<select class="form-control" name="department" id="department">
		<?php
$dep_sql1=$con->query("SELECT * FROM z_department_master");
$fet=$dep_sql1->fetch();
?>
		<option value="<?php echo $fet['id']; ?>"><?php echo $fet['dept_name']; ?></option>
		<?php
		$dep_sql=$con->query("SELECT * FROM  z_department_master");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option>
			<?php
		}
		?>
		</select>
	 <td>Employee Name:</td>

<td colspan="2">
<select class="form-control" name="employee" id="employee"value="<?php echo $row['employee']; ?>">
				
		</select> 
		</td>
		  <td><input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check()" value="Add">
		   <input type="button" class="btn btn-danger" id="enquiry_row_remove"  value="Remove">
		</td>
    </tr>
	</table>
<table class="table table-bordered">

 <tr>
<td>Project Timeline:</td>
<td colspan="2">
<input type="text" class="form-control" id="project_timeline" name="project_timeline" value="<?php echo $row['project_timeline']; ?>"></td>

<td>No of Working Hours:</td>
<td colspan="2">
<input type="text" class="form-control" id="no_of_working_hours" name="no_of_working_hours" value="<?php echo $row['no_of_working_hours']; ?>"></td>

</tr>
<tr>
<td>Modules: </td>
<td colspan="2">
<input type="text" class="form-control" id="modules" name="modules" value="<?php echo $row['modules']; ?>"></td>
<td><input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check1()" value="Add">
		  		   <input type="button" class="btn btn-danger" id="enquiry_row_remove1"  value="Remove1">

</td>
</tr>
<tr id="new">
	<td>
	</td>
	  </tr>

</table>
<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">
</form>
<script>
		function back()
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/Recruitment/project_management/project/project.php",
    success:function(data){
    $(".content").html(data);
    }
    })
  }
  </script>
<script>
  $(document).ready(function() {
$('#department').on('change', function() {

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

    function check() 
    {
    var len=$('#new_tab tr').length;	
    len=len+1; 
     $('#new_tab').append('<tr class="row_'+len+'"><td>Department Name:</td><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len+'" value="'+len+'"</td><td><select class="form-control" id="department_'+len+'"  name="department[]"><option value="1">Management</option><option value="2">Designing</option><option value="3">Development</option><option value="4">Digital Marketing</option><option value="5">Marketing</option><option value="6">HR & Admin</option><option value="7">Finance</option><option value="8">Purchase</option><option value="9">Service</option></select></td><td>Employee Name:</td><td colspan="2"><select class="form-control" id="employee_'+len+'"  name="employee[]"><option value="1">Jaikumar</option><option value="2">Rizwana</option><option value="3">Rajeshwari</option><option value="4">Mohana Krishnan</option><option value="5">Gopinath</option><option value="6">Sebastain</option><option value="7">Laxmi Priya</option><option value="8">Arunachalam</option><option value="9">Vanitha</option><option value="10">Jefferson Fernando</option><option value="11">Meena B</option><option value="12">Umadevi</option><option value="13">Sindhu G</option><option value="14">Girish Madhavan</option><option value="15">Ramakrishnan</option><option value="16">Arun</option><option value="17">Sakthi</option><option value="18">Mythili</option><option value="19">Karthikeyan</option><option value="20">Selvaraj</option><option value="21">Vaidyanathan</option><option value="22">Christy</option><option value="23">Muthuraj</option><option value="24">Kalai</option><option value="25">Shanmuganathan</option><option value="26">Karthik</option><option value="27">Venkatesan</option></select></td></tr>'); 
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
	<script>
	 function check1() 
    {
    var len=$('#new tr').length;	
    len=len+1; 
    $('#new').append('<tr class="row_'+len+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len+'" value="'+len+'"</td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td><input type="text" class="form-control" id="modules'+len+'"  name="modules[]"></td></tr>'); 
    }
	
	 $('#enquiry_row_remove1').click(function(){
    $('input:checkbox:checked.chk').map(function(){
    var id=$(this).val();
    var le=$('#new tr').length;

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
