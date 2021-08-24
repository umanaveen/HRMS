<?php
require '../../../connect.php';
$jid=$_REQUEST['jid'];
$sql=$con->query("SELECT *,j.status as status,j.id as jid FROM `jobdescription_form_details` j join jobdescription_master m on j.jobdescription_id=m.id join client_master c on j.client_id=c.id where j.id='$jid'");
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
			<input type="text" class="form-control" id="jd_title" name="jd_title" value="<?php echo $sfet['tittle']; ?>"readonly >
			</td>
      </tr>
		
	   <tr>
		    <td >Client: *</td>
			<td colspan="5">
			<input type="text" class="form-control" id="client" name="client"  value="<?php echo $sfet['client_name']; ?>"readonly>
			</td>
      </tr>
	  
		<tr>
		<td>Location :</td>
        <td><input type="text" class="form-control" id="location" name="location" value="<?php echo $sfet['location']; ?>"readonly></td>
		</tr>
		<tr>
		<td>Experience :</td>
        <td><input type="text" class="form-control" id="experience" name="experience" value="<?php echo $sfet['experience']; ?>"readonly></td>
		</tr>
		<tr>
		<td>Education Qualification:</td>
        <td><input type="text" class="form-control" id="education" name="education" value="<?php echo $sfet['education']; ?>"readonly></td>
		</tr>
		<tr>
		<td>Certifications :</td>
        <td><input type="text" class="form-control" id="certificate" name="certificate" value="<?php echo $sfet['certifications']; ?>"readonly></td>
		</tr>
		<tr>
		<tr>
		<td>Roles & Responsibilities:</td>
        <td><input type="text" class="form-control" id="roles" name="roles" style="height: 176px;" value="<?php echo $sfet['roles']; ?>"readonly></td>
		</tr>
		<tr>
		<tr>
		<td>Skills Required:</td>
        <td><input type="text" class="form-control" id="skills" name="skills" style="height: 176px;" value="<?php echo $sfet['skills']; ?>"readonly></td>
		</tr>
		<tr>
		<td>Date of Joining:</td>
        <td colspan="2"><input type="text" class="form-control" id="date_joining" name="date_joining" value="<?php echo $sfet['joining_date']; ?>"readonly></td>
		
        </tr>
		<tr>
		<td>Date to be closed:</td>
        <td colspan="2"><input type="text" class="form-control" id="date_close" name="date_close" value="<?php echo $sfet['closed_date']; ?>"readonly></td>
		
        </tr>
		<tr>
		<td>Replacement for:</td>
        <td colspan="2">
		<?php
		$person=$sfet['replacement'];
		$replace1=$con->query("SELECT r.candidate_id as candidate_id,s.emp_name FROM `resignation_form_details` r join staff_master s on r.candidate_id=s.candid_id where r.hod_accept_status='Yes' and r.hr_accept_status='Yes' and r.candidate_id='$person'");
		$refet=$replace1->fetch();
		?>
		<input type="text" class="form-control" id="replacement" name="replacement" value="<?php echo $refet['emp_name']; ?>" readonly></td>
		
        </tr>
		 <tr>
		<td>CTC:</td>
        <td colspan="2"><input type="text" class="form-control" id="ctc" name="ctc" value="<?php echo $sfet['ctc']; ?>" readonly></td>
	
        </tr>
		 
        <!---tr>  
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
