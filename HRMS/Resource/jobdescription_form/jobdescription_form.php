<?php
require '../../../connect.php';
?>
   <div class="card card-info">
              <div class="card-header">
                
				              <center><h3 class="card-title"><b>Job Description </b></h3></center>
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
			<option value="">Choose jd title</option>
			<?php $stmt = $con->query("SELECT * FROM jobdescription_master where status=1");
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
			<option value="">Choose Client</option>
			<?php $stmt = $con->query("SELECT * FROM client_master where status=1");
			while ($row = $stmt->fetch()) 
			{?>
			<option value="<?php echo $row['id']; ?>"> <?php echo $row['org_name']; ?> </option>
			<?php 
			} ?>
			</select>
			</td>
      </tr>
	  
		<tr>
		<td>Location :</td>
        <td><input type="text" class="form-control" id="location" name="location"></td>
		</tr>
		<tr>
		<td>Experience :</td>
        <td><input type="text" class="form-control" id="experience" name="experience"></td>
		</tr>
		<tr>
		<td>Education Qualification:</td>
        <td><input type="text" class="form-control" id="education" name="education"></td>
		</tr>
		<tr>
		<td>Certifications :</td>
        <td><input type="text" class="form-control" id="certificate" name="certificate"></td>
		</tr>
		<tr>
		<tr>
		<td>Roles & Responsibilities:</td>
        <td><textarea class="form-control" id="roles" name="roles"></textarea></td>
		</tr>
		<tr>
		<tr>
		<td>Skills Required:</td>
        <td><textarea class="form-control" id="skills" name="skills"></textarea></td>
		</tr>
		<tr>
		<td>Date of Joining:</td>
        <td colspan="2"><input type="date" class="form-control" id="date_joining" name="date_joining"></td>
		<p class="getDate"></p>
        </tr>
		<tr>
		<td>Date to be closed:</td>
        <td colspan="2"><input type="date" class="form-control" id="date_close" name="date_close" ></td>
		<p class="getDate"></p>
        </tr>
		<tr>
		<?php
		$replace=$con->query("SELECT r.candidate_id as candidate_id,s.emp_name FROM `resignation_form_details` r join staff_master s on r.candidate_id=s.candid_id where r.hod_accept_status='Yes' and r.hr_accept_status='Yes'");		
		?>
		<td>Replacement for:</td>
        <td colspan="2"><!--input type="text" class="form-control" id="replacement" name="replacement"-->
		<select class="form-control" id="replacement" name="replacement">
		<option value="">Select </option>
		<?php 
		while($redis=$replace->fetch())
		{
			?>
		<option value="<?php echo $redis['candidate_id'];?>"><?php echo $redis['emp_name'];?></option>
		<?php
		}
		?>
		</td>
		<p class="getDate"></p>
        </tr>
		 <tr>
		<td>CTC:</td>
        <td colspan="2"><input type="text" class="form-control" id="ctc" name="ctc"></td>
		<p class="getDate"></p>
        </tr>
		 
        <tr>  
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="jd_form()" style="float:right;" value="save"></td>
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
function jd_form()
{
	var field=1;
	var data = $('form').serialize();
	$.ajax({
		type:'GET',
		data:"field="+field, data,
		url:'/HRMS/HRMS/resource/jobdescription_form/jd_form_submit.php',
		success:function(data)
		{
			if(data==0)
			{
				alert("Form Data has not been Submitted");
				
				//window.location.href="login/logout.php";
				//candidate_form();
					resource_form();
			}
			else
			{
			alert("Form Data has been Submitted ... Hr will contact you please wait");
				//candidate_form();
			
				resource_list();
			}	
		}       	
	});
}
</script>
