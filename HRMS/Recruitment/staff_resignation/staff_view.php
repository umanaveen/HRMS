<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid=$_REQUEST['cid'];
$resignid=$_REQUEST['id'];
$sql=$con->query("SELECT *,s.emp_name as name,r.candidate_id as cid,r.id as id,z.dept_name as depname,dm.div_name as divname,dd.designation_name as desname FROM `resignation_form_details` r join staff_master s on r.candidate_id=s.candid_id join z_department_master z on z.id=s.dep_id join division_master dm on dm.id=s.div_id join designation_master dd on dd.id=s.design_id
where r.id='$resignid'");
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
        <td colspan="5"><input type="text" class="form-control" id="candidate_name" name="candidate_name" value="<?php echo $data['emp_name'];?>" readonly ></td>
        </tr>
       <tr>
        <td>Department:</td>
        <td colspan="5">
		<input type="text" class="form-control" id="dep_id" name="dep_id" value="<?php echo $data['depname'];?>" readonly>
		
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
		<input type="text" class="form-control" id="division" name="division" value="<?php echo $data['divname'];?>" readonly>
		
        <tr>
        <td>Designation:</td>
        <td colspan="5"><input type="text" class="form-control" id="designation" name="designation" value="<?php echo $data['desname'];?>" readonly>
		</td>
		
        </tr>
       <tr>
        <td>Reason for relieving:</td>
        <td colspan="5"><input type="text" class="form-control" id="reason" name="reason" value="<?php echo $data['hod_reason'];?>" readonly>
		</td>
		
        </tr>
      
        <tr>
        <td>Notice Period:</td>
        <td colspan="5"><input type="text" class="form-control" id="notice_period" name="notice_period" value="<?php echo $data['notice_period'];?>" readonly></td>
        </tr>
        <tr>
        <td>Projects to be handed over:</td>
        <td colspan="5"><input type="text" class="form-control" id="projects" name="projects" style="height: 100px;"value="<?php echo $data['handling_projects'];?>" readonly></td>
        </tr>
		
		<?php 
		$sta=$data['hod_accept_status'];
		if($sta=="Yes")
		{
			?>
			<tr>
        <td>Confirm Status</td>
        <td colspan="5"><input type="text" class="form-control" id="confirm" name="confirm" value="Accepted" readonly></td>
        </tr>
		
		
			<?php 
		}
		else
		{
			?>
			<tr>
        <td>Confirm Status</td>
        <td colspan="5"><input type="text" class="form-control" id="confirm" name="confirm" value="Rejected" readonly></td>
        </tr>
		<tr>
        <td>Remarks</td>
        <td colspan="5"><input type="text" class="form-control" id="confirm" name="confirm" value="<?php echo $data['hod_rejoin_remark'];?>" readonly></td>
        </tr>
			<?php
		}
		?>
		<?php 
		$sta=$data['status'];
		if($sta==4 or $sta==5)
		{
			?>
			
		<tr><td><h3>HR Feedback</h3></td></tr>
        
		<?php 
		$sta=$data['hr_accept_status'];
		if($sta=="Yes")
		{
			?>
			<tr>
        <td>Confirm Status</td>
        <td colspan="5"><input type="text" class="form-control" id="confirm" name="confirm" value="Accepted" readonly></td>
        </tr>
		
		
			<?php 
		}
		else
		{
			?>
			<tr>
        <td>Confirm Status</td>
        <td colspan="5"><input type="text" class="form-control" id="confirm" name="confirm" value="Rejected" readonly></td>
        </tr>
		<tr>
        <td>Remarks</td>
        <td colspan="5"><input type="text" class="form-control" id="confirm" name="confirm" value="<?php echo $data['hr_rejoin_remark'];?>" readonly></td>
        </tr>
			<?php
		}
		 
		}
		?>
        <!--tr>
        <td>Address Communication:</td>
        <td colspan="5"><input type="text" class="form-control" id="address" name="address" value="<?php echo $data['address'];?>" readonly ></td>
        </tr-->
       
        
        
     
        <!--tr>  
        <td colspan="6">
		<input type="hidden" name="cid" id="cid" value="<?php echo $candidateid;?>">
		<input type="button" class="btn btn-success" name="save" id="<?php echo $resignid; ?>"onclick="staff_update(this.id)" value="Update"></td>
        </tr-->
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
	/* function staff_update(v)
	{
		var reason=$('#reason').val();
		var notice_period=$('#notice_period').val();
		var projects=$('#projects').val();
		var cid=$('#cid').val();
		 $.ajax({
			type:"GET",
			data: "reason=" + reason +"&notice_period=" + notice_period +"&cid=" + cid +"&projects=" +projects ,
			url:"hrms/recruitment/staff/resign_update.php",
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
		 */
		function go_back()
{
	//alert("back");
	staff_resignation_list();
}
	</script>