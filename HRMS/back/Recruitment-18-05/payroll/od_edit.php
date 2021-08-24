<?php
require '../../connect.php';
 $id=$_REQUEST['id'];

$stmt = $con->prepare("SELECT manual_att.id AS manualid,manual_att.emp_id as manemp_id,manual_att.customer_name,manual_att.location,manual_att.date,manual_att.purpose,employee_master.id as emp_id,employee_master.code,employee_master.pf_number,employee_master.name,employee_master.dob,employee_master.department,employee_master.division,employee_master.section,employee_master.mail,employee_master.address1,employee_master.address2,employee_master.status FROM `manual_att` INNER JOIN employee_master on manual_att.emp_id=employee_master.id WHERE manual_att.id='$id'"); 
$stmt->execute(); 
$row = $stmt->fetch();
?>

<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> OD  EDIT
<a onclick="return back_od()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a>
</div>
<div class="card-body" id="printableArea">
<form method="POST" action="" enctype="multipart/type">
<table class="table table-bordered">
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>

<tr>
        <td colspan="6"><center><b>Edit OD</b></center></td>
        </tr>
        <tr>
        <td>Date</td>
            <td colspan="5"><input type="date" class="form-control"  id="date" name="date" value="<?php echo  $row[4]; ?>"></td>
        </tr>
               <tr>

							<td>Employee Name</td>
							<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $id;?>"readonly>
							<td>
							  <select class="form-control" name="Employee_name" id="Employee_name">
							 
					  
					  <?php
					  $emp_id=$row['emp_id'];
$sql=$con->query("SELECT * FROM employee_master where id='$emp_id'");
$stmt->execute(); 
$row1 = $stmt->fetch();
?>

<option value="<?php echo $row1['emp_id'];?>"><?php echo $row1['name'];?></option>
<?php

$sql1=$con->query("SELECT * FROM employee_master");
      $i=1;
      while($cmp = $sql1->fetch(PDO::FETCH_ASSOC))
      {
		  ?>
		  <option value="<?php echo $cmp['id'];?>"><?php echo $cmp['name'];?></option>
		  <?php
	  }
		  ?>
					  </select>
					</td>
						</tr>	
						
        <tr>
       <td>Customer Name</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Customer Name" id="Customer_name" name="Customer_name" value="<?php echo  $row[2]; ?>"></td>
        </tr>
       <tr>
       <td>Location</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Location" id="Location" name="Location" value="<?php echo  $row[3]; ?>"></td>
        </tr>
               <tr>
       <td>Purpose</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Purpose" id="Purpose" name="Purpose" value="<?php echo  $row[5]; ?>"></td>
        </tr>



</table>
<input type="button" class="btn btn-primary btn-md"  style="float:right;" name="Update" onclick="od_update()" value="Update"> 
</form>
</div>
</div>
</div>
<script>
	function back_od()
	{
		$.ajax({
		type:"POST",
		url:"Recruitment/payroll/od.php",
		success:function(data){
		$("#main_content").html(data);
		}
		})
	}
    function od_update()
    {
    var id=$('#get_id').val();
	//alert(id);
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data:"id="+id, data,
    url:'Recruitment/payroll/od_update.php',
    success:function(data)
    {
      if(data==1)
      { 
        alert('Not updated');
      
      }
      else
      {
        alert("Update Successfully");
		od()
      }
      
    }       
    });
    }
    </script>