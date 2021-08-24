<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid=$_REQUEST['id'];
$sql=$con->query("select * from candidate_form_details c join staff_master s on c.id=s.candid_id join z_department_master z on z.id=s.dep_id where c.id='$candidateid'");
/* echo "select * from candidate_form_details c join staff_master s on c.id=s.candid_id join z_department_master z on z.id=s.dep_id where c.id='$candidateid'"; */
//echo "select * from candidate_form_details  where id='$candidateid'";
$data=$sql->fetch();
?>

<div class="content-wrapper" style="padding-left: 50px;">
   <section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-body">
<div class="tab-content">
    <div class="active tab-pane" id="for_employment">
    <form method="POST" enctype="multipart/form-data">
    <!-- Post --><input type="button" name="back" id="back" data-toggle="tab" class="btn btn-danger" value="Back" onclick="go_back()">
    <table class="table table-bordered">
        <tr>
        <td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
        <td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
        </tr>
        <tr>
        <td colspan="6"><center><b> Employee Detail</b></center></td>
        </tr>
        <!--tr>
        <td>Post Applied for:</td>
        <td colspan="5"><input type="text" class="form-control" id="position" name="position" value="<?php echo $data['position'];?>" readonly ></td>
        </tr-->
        <!--tr>
        <td colspan="6"><center><b>Personal Details</b></center></td>
        </tr-->
        <tr>
        <td>Employee Code:</td>
        <td colspan="5"><input type="text" class="form-control" id="candidate_code" name="candidate_code" value="<?php echo $data['prefix_code'].$data['emp_code'];?>" readonly></td>
        </tr>
       <tr>
        <td>Name of the Employee:</td>
        <td colspan="5"><input type="text" class="form-control" id="candidate_name" name="candidate_name" value="<?php echo $data['first_name']." ". $data['last_name'];?>" ></td>
        </tr>
       <tr>
        <td>Department:</td>
        <td colspan="5">
		<select class="form-control" name="department" id="department" >
		<?php 
		$depid=$data['dep_id'];
		$dep1=$con->query("select * from z_department_master where id='$depid'");
		$fet=$dep1->fetch();
		?>
	<option value="<?php echo $fet['id']; ?>"><?php echo $fet['dept_name']; ?></option>
	<?php
	$dep=$con->query("select * from z_department_master");
	while($dep_sql_res=$dep->fetch(PDO::FETCH_ASSOC))
	{
	?>
	<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option>
	<?php
	}
	?>
	</select>
		
		</td>
        </tr>
        <tr>
        <td>Division:</td>
        <td colspan="5">
		<!--?php
		$did=$data['department'];
		$sel=$con->query("select * from division_master where dep_id='$did'");
		$val=$sel->fetch();		
		?-->
		<!--input type="text" class="form-control" id="division" name="division" value="<?php echo $val['div_name'];?>" readonly-->
		<select class="form-control" name="division" id="division">
			<?php 
		$divid=$data['div_id'];
		$div1=$con->query("select * from division_master where id='$divid'");
		$divs=$div1->fetch();
		?>
	<option value="<?php echo $divs['id']; ?>"><?php echo $divs['div_name']; ?></option>
	<?php
	$div_sql=$con->query("select * from division_master");
	while($div_sql_res=$div_sql->fetch(PDO::FETCH_ASSOC))
	{
	?>
	<option value="<?php echo $div_sql_res['id']; ?>"><?php echo $div_sql_res['div_name']; ?></option>
	<?php
	}
	?>
	</select>
		</td>
        </tr>
        <tr>
        <td>Designation:</td>
		<!--?php
		$did=$data['department'];
		$select=$con->query("select * from designation_master where dep_id='$did'");
		$des=$select->fetch();		
		?-->
        <td colspan="5"><!--input type="text" class="form-control" id="designation" name="designation" value="<?php echo $des['designation_name'];?>" readonly-->
		<select class="form-control" name="designation" id="designation">
		<?php 
		$desid=$data['design_id'];
		$des1=$con->query("select * from designation_master where id='$desid'");
		$des=$des1->fetch();
		?>
	<option value="<?php echo $des['id']; ?>"><?php echo $des['designation_name']; ?></option>
	<?php
	$div_sql=$con->query("select * from designation_master");
	while($div_sql_res=$div_sql->fetch(PDO::FETCH_ASSOC))
	{
	?>
	<option value="<?php echo $div_sql_res['id']; ?>"><?php echo $div_sql_res['designation_name']; ?></option>
	<?php
	}
	?>
	</select></td>
		
        </tr>
      <tr>
	  <td>Reporting Person</td>
	  <td colspan="5"><!--input type="text" class="form-control" id="designation" name="designation" value="<?php echo $des['designation_name'];?>" readonly-->
		<select class="form-control" name="reporting_to" id="reporting_to">
		<?php
	$reportingper_id=$data['reporting_person'];
	$psel=$con->query("select * from staff_master where id='$reportingper_id'");
	$pfet=$psel->fetch(PDO::FETCH_ASSOC);
	$person_name=$pfet['emp_name'];
	?>
	<option value="<?php  echo $reportingper_id;?>"><?php echo $person_name; ?></option>
	<?php
	$div_sql=$con->query("select * from staff_master");
	while($div_sql_res=$div_sql->fetch(PDO::FETCH_ASSOC))
	{
	?>
	<option value="<?php echo $div_sql_res['id']; ?>"><?php echo $div_sql_res['emp_name']; ?></option>
	<?php
	}
	?>
	</select></td>
		
	  </tr>
	  <tr>
	  <td>Head Status</td>
	  <?php 
	  $heads=$data['head_status'];
	  if($heads==0)
	  {
		 ?>
		  <td>
	  
	  <input type="radio" name="head_status" id="no" value="0" checked>
	  <label for="no">no</label>
	  </td>
	  <td>
	  <input type="radio" name="head_status" id="yes" value="1">
	  <label for="no">Yes</label>
	  </td>
<?php		 
	  }
	  elseif($heads==1)

	  {
		  ?>
		   <td>
	  
	  <input type="radio" name="head_status" id="no" value="0">
	  <label for="no">no</label>
	  </td>
	  <td>
	  <input type="radio" name="head_status" id="yes" value="1" checked>
	  <label for="no">Yes</label>
	  </td>
		  <?php
		  
	  }	
else
{
	?>
	
		   <td>
	  
	  <input type="radio" name="head_status" id="no" value="0">
	  <label for="no">no</label>
	  </td>
	  <td>
	  <input type="radio" name="head_status" id="yes" value="1" >
	  <label for="no">Yes</label>
	  </td>
	<?php
}
	  ?>
	 
	  
	  </tr>
	  <tr>
	    <td>Status </td>	  
	    <td>	  
	  <input type="radio" name="status" id="status" value="1">
	  <label for="Active">Active</label>
	  </td>
	  <td>
	  <input type="radio" name="status" id="status" value="2" >
	  <label for="Inactive">Inactive</label>
	  </td>
	  </tr>
        <!--tr>
        <td>Date of Birth:</td>
        <td colspan="5"><input type="date" class="form-control" id="dob" name="dob" value="<?php echo $data['dob'];?>" readonly></td>
        </tr>
        <tr>
        <td>Address Communication:</td>
        <td colspan="5"><input type="text" class="form-control" id="address" name="address" value="<?php echo $data['address'];?>" readonly ></td>
        </tr-->
       
        
        
     
        <tr>  
        <td colspan="6">
		<input type="hidden" name="cid" id="cid" value="<?php echo $candidateid;?>">
		<input type="button" class="btn btn-success" name="save" id="<?php echo $candidateid; ?>"onclick="staff_update(this.id)" value="Update"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
	
	<script>
	function staff_update(v)
	{
		var cname=$('#candidate_name').val();
		var ccode=$('#candidate_code').val();
		var deprt=$('#department').val();
		var div=$('#division').val();
		var desig=$('#designation').val();
		var reporing=$('#reporting_to').val();
		var cid=$('#cid').val();		
		var radioValue = $("input[name='head_status']:checked").val();
		var status = $("input[name='status']:checked").val();
		//var fdata=$('#form').serialize();
		 $.ajax({
			type:"GET",
			data: "cname=" + cname +"&ccode=" + ccode +"&deprt=" + deprt +"&div=" + div +"&desig=" + desig +"&cid=" + cid +"&reporting=" +reporing+"&head_status=" +radioValue+"&status="+status ,
			url:"hrms/recruitment/staff/staff_update.php",
			success:function(data)
			{
				if(data==0)
				{
					alert("upadted successfully");
					staff_list();
				}
				
			}
					
		 })
		
		}
		
		function go_back()
{
	//alert("back");
	staff_list();
}
	</script>