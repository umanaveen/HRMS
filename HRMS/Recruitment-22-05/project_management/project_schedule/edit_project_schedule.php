<?php
require '../../../../connect.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("select * from project_timeline where id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();
//$hid=$row['emp_name'];
//$id=$row['asset'];
?>
<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> PROJECT DETAILS EDIT
<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
</div>
<div class="card-body" id="printableArea">
<form role="form" name="" action="HRMS/Recruitment/project_management/project_schedule/update_project_schedule.php" method="post" enctype="multipart/type">

<table class="table table-bordered">
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
 <table class="table table-bordered" id="new_tab">

<TR>
		  <TH>
			<INPUT type="checkbox" name="select-all" id="select-all" onclick="toggle(this);">
		  </TH> 
		  <th>Client Name</th>
		  <th>Project Name</th>
		  <th>Modules</th>
		  <TH>Employees</TH>
		  <th>No Of Working Hours</th>
		  <th>Date</th>
		  		  <th>Action</th>

		</TR>
		<TR>
		  <TD>
			<INPUT type="checkbox" name="chk[]">
		  </TD>
		  <TD>
<select id="client_name" name="client_name" class="form-control">
<?php
$dep_sql1=$con->query("SELECT * FROM project where id='$id' ");
$fet=$dep_sql1->fetch();
?>

		<option value="<?php echo $fet['id'];?>"><?php echo $fet['client'];?></option>
		<?php
		$dep_sql=$con->query("SELECT * FROM project");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['client']; ?></option>
			<?php
		}
		?>
		</select></td>
		  		  <TD>
<select id="client_name" name="project_name" class="form-control">
<?php
$dep_sql1=$con->query("SELECT * FROM project where id='$id' ");
$fet=$dep_sql1->fetch();
?>

		<option value="<?php echo $fet['id'];?>"><?php echo $fet['project_name'];?></option>

		<?php
		$dep_sql=$con->query("SELECT * FROM project");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['project_name']; ?></option>
			<?php
		}
		?>
		</select>
		  </td>
		  <TD>
			<input type="text" id="modules" name="modules" class="form-control" value="<?php echo  $row['modules'];?>"></td>

		  <TD>
<select class="form-control" name="employees" value="<?php echo  $row['employees'];?>">
<?php
$dep_sql1=$con->query("SELECT * FROM project where id='$id' ");
$fet=$dep_sql1->fetch();
?>

		<option value="<?php echo $fet['id'];?>"><?php echo $fet['employee'];?></option>
		<?php
		$dep_sql=$con->query("SELECT * FROM project");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['employee']; ?></option>
			<?php
		}
		?>
		</select>	</td>		<td>
			<input type="text" id="no_of_working_hours" name="no_of_working_hours" class="form-control" value="<?php echo  $row['no_of_working_hours'];?>"></td>
			<td>
						<input type="hidden" class="form-control" id="id" name="id" value="<?php echo  $id;?>">

			<input type="date" id="date" name="date" class="form-control" value="<?php echo  $row['date'];?>"></td>
		<td>
		<input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check()" value="Add">
		   <input type="button" class="btn btn-danger" id="enquiry_row_remove"  value="Remove">
		</td>
		 <tr id="new_tab">
	<td>
	</td></TR>
</table>
<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">
</form>
<script>
		function back()
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/Recruitment/project_management/project_schedule/project_schedule.php",
    success:function(data){
    $(".content").html(data);
    }
    })
  }
 function check() 
    {
    var len=$('#new_tab tr').length;	
    len=len+1; 
     $('#new_tab').append('<tr class="row_'+len+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len+'" value="'+len+'"</td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td><select class="form-control" id="client_name_'+len+'"  name="client_name[]" value="<?php echo  $row['client'];?>"><option value="1">8</option><option value="2">9</option><option value="3">1</option><option value="4">8</option><option value="5">6</option></select></td><td><select class="form-control" id="project_name_'+len+'"  name="project_name[]" value="<?php echo  $row['project_name'];?>"><option value="1">Project Management</option><option value="2">HRMS</option></select></td><td><input type="text" class="form-control" id="modules'+len+'"  name="modules[]" value="<?php echo  $row['modules'];?>"></td><td><select class="form-control" id="employee_'+len+'"  name="employee[]" value="<?php echo  $row['employees'];?>"><option value="1">Jaikumar</option><option value="2">Rizwana</option><option value="3">Rajeshwari</option><option value="4">Mohana Krishnan</option><option value="5">Gopinath</option><option value="6">Sebastain</option><option value="7">Laxmi Priya</option><option value="8">Arunachalam</option><option value="9">Vanitha</option><option value="10">Jefferson Fernando</option><option value="11">Meena B</option><option value="12">Umadevi</option><option value="13">Sindhu G</option><option value="14">Girish Madhavan</option><option value="15">Ramakrishnan</option><option value="16">Arun</option><option value="17">Sakthi</option><option value="18">Mythili</option><option value="19">Karthikeyan</option><option value="20">Selvaraj</option><option value="21">Vaidyanathan</option><option value="22">Christy</option><option value="23">Muthuraj</option><option value="24">Kalai</option><option value="25">Shanmuganathan</option><option value="26">Karthik</option><option value="27">Venkatesan</option></select></td><td><input type="text" class="form-control" id="no_of_working_hours_'+len+'"  name="no_of_working_hours_[]" value="<?php echo  $row['no_of_working_hours'];?>"></td><td><input type="date" class="form-control" id="date_'+len+'"  name="date[]" value="<?php echo  $row['date'];?>"></td></tr>'); 
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

