<?php
require '../../../connect.php';
$jid=$_REQUEST['jid'];
$sql=$con->query("SELECT *,j.status as status,j.id as jid FROM `jobdescription_form_details` j left join jobdescription_master m on j.jobdescription_id=m.id left join client_master c on j.client_id=c.id where j.id='$jid'");
$sfet=$sql->fetch();
?>
   <div class="card card-info">
              <div class="card-header">
                
				              <center><h3 class="card-title"><b>Job Description</b></h3></center>
		<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
              </div>
			
   <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
        <tr>
        <td><center><img src="/HRMS/HRMS/Recruitment/image/userlog/bluebase.png"  style="width:300px;height:150px;"></center></td>
        <td colspan="5"><center><h1><b>Bluebase Software services Pvt Ltd</b></h1></center></td>
        </tr>
        <tr>
			<td colspan="6"><center><b>Job Description Form</b></center></td>
        </tr>
	   <tr>
		    <td >JD Title: *</td>
			<td colspan="5">
			<select class="form-control" id="jd_title" name="jd_title" >
			<?php $jtid=$sfet['jobdescription_id'];
			
			$jsel=$con->query("select * from jobdescription_master where id='$jtid'");
			$jtfet=$jsel->fetch();
			?>
			<option value="<?php echo $jtfet['id'];?>"><?php echo $jtfet['tittle'];?></option>
			<?php $stmt = $con->query("SELECT * FROM jobdescription_master where status=1 and id !=$jtid");
			while ($row = $stmt->fetch()) 
			{?>
			<option value="<?php echo $row['id']; ?>"> <?php echo $row['tittle']; ?> </option>
			<?php 
			} ?>
			</select>
			</td>
      </tr>
		
	   <tr>
		    <td >Client: *</td>
			<td colspan="5">
			<select class="form-control" id="client" name="client">
			<?php 
			$cid=$sfet['client_id'];
			$csel=$con->query("select * from client_master where id='$cid'");
			$cfet=$csel->fetch();
			?>
			<option value="<?php echo $cfet['id'];?>"><?php echo $cfet['client_name'];?></option>
			<?php $stmt = $con->query("SELECT * FROM client_master where status=1 and id !='$cid'");
			while ($row = $stmt->fetch()) 
			{?>
			<option value="<?php echo $row['id']; ?>"> <?php echo $row['client_name']; ?> </option>
			<?php 
			} ?>
			</select>
			</td>
      </tr>
	  
		<tr>
		<td>Location :</td>
        <td><input type="text" class="form-control" id="location" name="location" value="<?php echo $sfet['location']; ?>"></td>
		</tr>
		<tr>
		<td>Experience :</td>
        <td><input type="text" class="form-control" id="experience" name="experience" value="<?php echo $sfet['experience']; ?>"></td>
		</tr>
		<tr>
		<td>Education Qualification:</td>
        <td><input type="text" class="form-control" id="education" name="education" value="<?php echo $sfet['education']; ?>"></td>
		</tr>
		<tr>
		<td>Certifications :</td>
        <td><input type="text" class="form-control" id="certificate" name="certificate" value="<?php echo $sfet['certifications']; ?>"></td>
		</tr>
		<tr>
		<tr>
		<td>Roles & Responsibilities:</td>
        <td><input type="text" class="form-control" id="roles" name="roles" style="height: 176px;" value="<?php echo $sfet['roles']; ?>" ></td>
		</tr>
		<tr>
		<tr>
		<td>Skills Required:</td>
        <td><input type="text" class="form-control" id="skills" name="skills" style="height: 176px;" value="<?php echo $sfet['skills']; ?>"></td>
		</tr>
		<tr>
		<td>Date of Joining:</td>
        <td colspan="2"><input type="date" class="form-control" id="date_joining" name="date_joining" value="<?php echo $sfet['joining_date']; ?>"></td>
		<p class="getDate"></p>
        </tr>
		<tr>
		<td>Date to be closed:</td>
        <td colspan="2"><input type="date" class="form-control" id="date_close" name="date_close" value="<?php echo $sfet['closed_date']; ?>"></td>
		<p class="getDate"></p>
        </tr>
		<tr>
		<td>Replacement for:</td>
        <td colspan="2"><!--input type="text" class="form-control" id="replacement" name="replacement" value="<!?php echo $sfet['replacement']; ?>"-->
		<select class="form-control" id="replacement" name="replacement">
		<?php
		$person=$sfet['replacement'];
		$replace1=$con->query("SELECT r.candidate_id as candidate_id,s.emp_name FROM `resignation_form_details` r join staff_master s on r.candidate_id=s.candid_id where r.hod_accept_status='Yes' and r.hr_accept_status='Yes' and r.candidate_id='$person'");
		$refet=$replace1->fetch();
		?>
		<option value="<?php echo $refet['candidate_id'];?>"><?php echo $refet['emp_name'];?></option>
		 
		<?php
		$replace=$con->query("SELECT r.candidate_id as candidate_id,s.emp_name FROM `resignation_form_details` r join staff_master s on r.candidate_id=s.candid_id where r.hod_accept_status='Yes' and r.hr_accept_status='Yes'");
		
		while($redis=$replace->fetch())
		{
			?>
		<option value="<?php echo $redis['candidate_id'];?>"><?php echo $redis['emp_name'];?></option>
		<?php
		}
		?>
		</td>
        </tr>
		 <tr>
		<td>CTC:</td>
        <td colspan="2"><input type="text" class="form-control" id="ctc" name="ctc" value="<?php echo $sfet['ctc']; ?>"></td>
		
        </tr>
		 
        <tr>  
        <td colspan="6">
		<input type="hidden" name="jid" id="jid" value="<?php echo $jid;?>">
		<input type="button" class="btn btn-success" name="save" onclick="jd_form_update()" style="float:right;" value="Update"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>



<script>
function back()
	{
		jobdescription_form();
	}
function jd_form_update()
{
	var field=1;
	var data = $('form').serialize();
	$.ajax({
		type:'GET',
		data:"field="+field, data,
		url:'/HRMS/HRMS/resource/jobdescription_form/jd_form_update.php',
		success:function(data)
		{
			if(data==1)
			{
				alert("Updated successfully");
				
				//window.location.href="login/logout.php";
				//candidate_form();
					jobdescription_form();
			}
			else
			{
			alert("Updated  successfully");
				//candidate_form();
			
				jobdescription_form();
			}	
		}       	
	});
}
</script>
