<?php
require '../../connect.php';
include('../../user.php');
include_once("function.php");
$resource_id=$_SESSION['resource_id'];
$new=new DB_con ();
$fetch=$new->fetchdata($resource_id);
$fet=$fetch->fetch();

?>
<div class="content-wrapper" style="padding-left: 50px;">
   <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
        <tr>
        <td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
        <td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
        </tr>
        <tr>
        <td colspan="6"><center><b>Application for Candidate</b></center></td>
        </tr>
		
        <tr>
        <td>Post Applied for: *</td>
        <td colspan="2">
		
		<!--select class="form-control" id="position" name="position" required>
		<option value="">Choose designation</option>
		<!?php $stmt1 = $con->query("SELECT * FROM designation_master where status=1 and id!=1");
		while ($row1 = $stmt1->fetch()) {?>
		<option value="<!?php echo $row1['id']; ?>"> <!?php echo $row1['designation_name']; ?> </option>
		<!?php } ?>
		</select-->
		
		<input type="hidden" class="form-control" id="position" name="position" value="<?php echo $fet['position']; ?>" readonly>
		<input type="text" class="form-control" id="position1" name="position1" value="<?php echo $fet['designation_name']; ?>" readonly></td>
		<td>Department: *</td>
		<td colspan="2">
		<?php
		$did=$fet['position'];; 
		$dep=$con->query("select * from designation_master  where id='$did'");
		$fetch=$dep->fetch();
		$depid=$fetch['dep_id'];
		
		?>
		<input type="hidden" class="form-control" id="tech_department" name="tech_department" value="<?php echo $depid; ?>" readonly>
		<input type="text" class="form-control" id="tech_department1" name="tech_department1" value="<?php echo $fet['dept_name']; ?>" readonly></td>
        </tr>
        <tr>
        <td colspan="6"><center><b>Personal Details</b></center></td>
        </tr>
        <tr>
        <td>First Name: *</td>
        <td colspan="2"><input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $fet['first_name']; ?>" readonly></td>
		<td>Last Name: *</td>
        <td colspan="2"><input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $fet['last_name']; ?>" readonly></td>
        </tr>
        <tr>
		<td>Gender:</td>
		<td colspan="5">
<?php
$gen=$fet['gender'];
if($gen=='male')
{
	?>
	
   <label> <input type="radio" name="gender" value="male" checked>&nbsp;Male</label>
<?php
}
else{
	?>
	<label><input type="radio" name="gender" value="female" checked>&nbsp;Female</label>
<?php
}
?>
		
	</td>
	</tr>
        <tr>
        <td>Father Name:</td>
        <td colspan="5"><input type="text" class="form-control" id="father_name" name="father_name" ></td>
        </tr>
        <tr>
        <td>Date of Birth:</td>
        <td colspan="5"><input type="date" class="form-control" id="dob" name="dob" ></td>
        </tr>
        <tr>
        <td>Address Communication: *</td>
        <td colspan="5"><input type="text" class="form-control" id="address" name="address" required></td>
        </tr>
        <tr>
        <td>Permanent Address:</td>
        <td colspan="5"><input type="text" class="form-control" id="paddress" name="paddress" ></td>
        </tr>
        <tr>
        <td>Mobile Number: *</td>
        <td colspan="5"><input type="text" class="form-control" id="phone" name="phone" onchange="CheckIndianNumber(this.value)" placeholder="+91"value="<?php echo $fet['mobile']; ?>" readonly></td>
        </tr>
       <tr>
        <td>Alternate Mobile Number: </td>
        <td colspan="5"><input type="text" class="form-control" id="a_phone" name="a_phone" onchange="CheckIndianNumber1(this.value)" placeholder="+91"></td>
        </tr>
        <tr>
        <td>Email ID : *</td>
        <td colspan="5"><input type="text" class="form-control" id="mail" name="mail" value="<?php echo $fet['mail']; ?>" readonly></td>
        </tr>
        <tr>
        <td>Aadhar Number: *</td>
        <td colspan="4"><input type="text" class="form-control" id="adharnumber" name="adharnumber" value="<?php echo $fet['aadhar_no']; ?>" readonly></td>
        </tr>
        <tr>
        <td>Pan Number:</td>
        <td colspan="4"><input type="text" class="form-control" id="pannumber" name="pannumber" onchange="panvalid(this.value)"></td>
        </tr>
        <!--tr>
        <td>Voter ID:</td>
        <td colspan="4"><input type="text" class="form-control" id="voternumber" name="voternumber"></td>
        </tr-->
		<tr>
        <td>Educational Details: *</td>
        <td colspan="4"><input type="text" class="form-control" id="educationalDetails" name="educationalDetails" value="<?php echo $fet['degree']; ?>" readonly></td>
        </tr>
        <tr>
        <td>Employement Status:</td>        	
		 <td colspan="4"><input type="text" class="form-control" id="EmployeeStatus" name="EmployeeStatus" value="<?php echo $fet['employement_status']; ?>" readonly></td>
        </tr>
		<tr id='employee_new'>
		<td>Year of Passout </td>
        <td colspan="4"><input type="text" class="form-control" id="year_of_pass" name="year_of_pass" value="<?php echo $fet['year_of_pass']; ?>" readonly></td>
        </tr>
		<tr id='employee_status'>
        <td>Company Name:</td>
        <td colspan="2"><input type="text" class="form-control" id="companyname" name="companyname" value="<?php echo $fet['company_name']; ?>" readonly></td>
		<td>No of Year Experience:</td>
        <td colspan="2"><input type="number" class="form-control" id="no_of_year" name="no_of_year" value="<?php echo $fet['year_experience']; ?>" readonly></td>
        </tr>
		 <tr>
        <td>photo:</td>
        <td colspan="5">
		<input type="file" class="form-control" id="photo" name="photo" />
		</td>
        </tr>
        <tr>
        <td>Resume: *</td>
        <td colspan="5">
		<input type="file" class="form-control" id="file3" name="files3" />
		</td>
        </tr>
        <tr>  
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="candidate_formS()" style="float:right;" value="save"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>
</div>


  <script type="text/javascript">  
  //mobile no validation
    function CheckIndianNumber(b)   
    {  
         var a = /^\d{10}$/;  
        if (a.test(b))   
        {  
            alert("Your Mobile Number Is Valid.")  
        }   
        else   
        {  
            alert("Your Mobile Number Is Not Valid.")  
			$('#phone').val('');
        }   
    };
//alternative no	
	function CheckIndianNumber1(b)   
    {  
         var a = /^\d{10}$/;  
        if (a.test(b))   
        {  
            alert("Your Mobile Number Is Valid.")  
        }   
        else   
        {  
            alert("Your Mobile Number Is Not Valid.")  
			$('#a_phone').val('');
        }   
    };  
	
	//Email address
	 function ValidateEmail(email) 
	 {
		 var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            //var address = document.getElementById[email].value;
            if (reg.test(email) == false) 
            {
                alert('Invalid Email Address');
                //return (false);
				$('#mail').val('');
            }
 }
//aadhar 
   function validation()
       {   
            
            var regexp=/^[2-9]{1}[0-9]{3}\s{1}[0-9]{4}\s{1}[0-9]{4}$/;           
            var x=document.getElementById("adharnumber").value;
           if(regexp.test(x))
               {
                   window.alert("Valid Aadhar no.");
                   
               }
			else
				{ 
				window.alert("Invalid Aadhar no.");
				$('#adharnumber').val('');
              }
	   }
	   
//pan number
      
$("#pannumber").change(function () {      
var inputvalues = $(this).val();      
  var regex = /[A-Z]{5}[0-9]{4}[A-Z]{1}$/;    
  if(!regex.test(inputvalues)){      
  $("#pannumber").val("");    
  alert("invalid PAN no");    
  return regex.test(inputvalues);    
  }    
});      
  
//voter id
$("#voternumber").change(function () {      
var inputvalues = $(this).val();      
  var regex = /^([a-zA-Z]){3}([0-9]){7}?$/g;   
  if(!regex.test(inputvalues)){      
  $("#voternumber").val("");    
  alert("invalid voter no");    
  return regex.test(inputvalues);    
  }    
});      
      
</script>
<script>
function employeestatus(value)
{
if(value=='Fresher')
{
document.getElementById('employee_status').style.visibility = "hidden";
document.getElementById('employee_new').style.visibility = "visible";
}
else
{
document.getElementById('employee_status').style.visibility = "visible";
document.getElementById('employee_new').style.visibility = "hidden";
}
}
$(document).ready (function(){
	document.getElementById('can_qn').style.visibility = "hidden";

});
function candidate_formS()
{
	var field=1;
	var data = $('form').serialize();
	$.ajax({
		type:'GET',
		data:"field="+field, data,
		url:'/HRMS/HRMS/candidate/candidate_submit.php',
		success:function(data)
		{
			if(data==0)
			{
				alert("Form Data has not been Submitted");
				//window.location.href="login/logout.php";
				candidate_form();
			}
			else
			{
				alert("Form Data has been Submitted ... Hr will contact you please wait");
				
				//window.location.href="login/logout.php";
				candidate_form();
			}	
		}       
	});
}
</script> 