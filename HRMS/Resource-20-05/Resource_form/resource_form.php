<?php
require '../../../connect.php';
?>
<style>
.highlight-error {
  border-color: red;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div class="content-wrapper" style="padding-left: 50px;">
   <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
        <tr>
        <td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
        <td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
        </tr>
        <tr>
			<td colspan="6"><center><b>Resource Form</b></center></td>
        </tr>
	   <tr>
		    <td >Source: *</td>
			<td colspan="5">
			<select class="form-control" id="source" name="source" onchange="get_consname(this.value)" required>
			<option value="">Choose Source</option>
			<?php $stmt = $con->query("SELECT * FROM source_master where status=1");
			while ($row = $stmt->fetch()) 
			{?>
			<option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
			<?php 
			} ?>
			</select>
			</td>
      </tr>
		<tr id="cname">
			<td>Consultant Name:</td>
			<td colspan="5"><input type="text" class="form-control" name="consl_name" id="consl_name" >
			</td>
		</tr>
		<tr>
			<td>Date:</td>
			<td colspan="5"><input type="date" class="form-control" name="consl_date" id="consl_date" >
			</td>
		</tr>
		
        <tr>
			<td>Post Applied for: *</td>
			<td colspan="5">
				<select class="form-control" id="position" name="position" required>
				<option value="">Choose designation</option>
				<?php $stmt1 = $con->query("SELECT * FROM designation_master where status=1 and id !=1");
				while ($row1 = $stmt1->fetch()) 
				{?>
				<option value="<?php echo $row1['id']; ?>"> <?php echo $row1['designation_name'];?> </option>
				<?php 
				} ?>
				</select>
			<!--input type="text" class="form-control" id="position" name="position" required -->
			</td>
				<!--td>Department: *</td>
				<td colspan="2">
					<select class="form-control" id="tech_department" name="tech_department" required >
					<option value="">Choose Department</option>
					<!?php $stmt = $con->query("SELECT * FROM z_department_master where status=1");
					while ($row = $stmt->fetch()) {?>
					<option value="<!?php echo $row['id']; ?>"> <!?php echo $row['dept_name']; ?> </option>
					<!?php } ?>
					</select>
				</td-->
        </tr>
        <tr>
			<td colspan="6"><center><b>Personal Details</b></center></td>
        </tr>
        <tr>
			<td>First Name: *</td>
			<td colspan="2"><input type="text" class="form-control" id="first_name" name="first_name" required></td>
			<td>Last Name: *</td>
			<td colspan="2"><input type="text" class="form-control" id="last_name" name="last_name" required></td>
        </tr>
    <tr>
			<td>Gender:</td>
			<td colspan="5"> <label>
		<input type="radio" name="gender" value="male" checked>&nbsp;Male</label>
	  <label>
		<input type="radio" name="gender" value="female">&nbsp;Female</label>
		</td>
	</tr>
        <!--tr>
        <td>Father's Name:</td>
        <td colspan="5"><input type="text" class="form-control" id="father_name" name="father_name" ></td>
        </tr>
        <tr>
        <td>Date of Birth:</td>
        <td colspan="5"><input type="date" class="form-control" id="dob" name="dob" ></td>
        </tr>
        <tr-->
        <!--td>Address Communication: *</td>
        <td colspan="5"><input type="text" class="form-control" id="address" name="address" required></td>
        </tr>
        <tr>
        <td>Permanent Address:</td>
        <td colspan="5"><input type="text" class="form-control" id="paddress" name="paddress" ></td>
        </tr-->
        <tr>
        <td>Mobile Number: *</td>
        <td colspan="5"><input type="text" class="form-control" id="phone" name="phone" onchange="CheckIndianNumber(this.value)" placeholder="+91"required></td>
        </tr>
        <tr>
        <td>WhatsApp Number: </td>
        <td colspan="5"><input type="text" class="form-control" id="whatsapp" name="whatsapp" onchange="CheckIndianNumber1(this.value)" placeholder="+91"></td>
        </tr>
        <tr>
        <td>Email ID : *</td>
        <td colspan="5"><input type="text" class="form-control" id="mail" name="mail" required onchange="ValidateEmail(this.value)"></td>
        </tr>
        <tr>
        <td>Aadhar Number:</td>
        <td colspan="4">
		<input type="text" class="form-control" id="adharnumber" name="adharnumber" data-type="adhaar-number" maxLength="14" >
		</td>
        </tr>
        <!--tr>
        <td>Pan Number:</td>
        <td colspan="4"><input type="text" class="form-control" id="pannumber" name="pannumber" onchange="panvalid(this.value)"></td>
        </tr>
        <tr>
        <td>Voter ID:</td>
        <td colspan="4"><input type="text" class="form-control" id="voternumber" name="voternumber"></td>
        </tr-->
		<tr>
		<td colspan="6"><center><b>Educational Qualification</center></b></td>
		</tr>
		<tr>
        <td>Degree: *</td>
        <td colspan="4"><input type="text" class="form-control" id="degree" name="degree" required>
		</td>
        </tr>
       <tr>
        <td>University: *</td>
        <td colspan="4"><input type="text" class="form-control" id="university" name="university" required>
		</td>
        </tr>
        
		<tr id='employee_new'>
		<td>Year of Passout </td>
        <td colspan="4"><input type="text" class="form-control" id="year_of_pass" name="year_of_pass"></td>
        </tr>
		<tr id='employee_new1'>
		<td>Percentage(%) </td>
        <td colspan="4"><input type="text" class="form-control" id="percentage" name="percentage" maxlength="2"></td>
        </tr>
		<tr>
        <td>Employement Status:</td>
        <td colspan="4">	
		<select class="form-control" id="EmployeeStatus" name="EmployeeStatus" onchange="emp_status(this.value)" required>
		<option value="">Choose Employeement Status</option>
		<option value="Fresher">Fresher</option>
		<option value="Experience">Experience</option>
		</select>
		</td>
        </tr>		
		<tr id='employee_status'>
        <td>Company Name:</td>
        <td colspan="2"><input type="text" class="form-control" id="companyname" name="companyname"></td>
		<td>No of Year Experience:</td>
        <td colspan="2"><input type="number" class="form-control" id="no_of_year" name="no_of_year"></td>
        </tr>
		<tr>
		<td colspan="6"><center><b>Certification Details</center></b></td>
		</tr>
		<tr>
        <td>Certification:</td>
        <td colspan="4">	
		<select class="form-control" id="cer_status" name="cer_status" onchange="cer_status1(this.value)" required>
		<option value="">Choose Certification Status</option>
		<option value="yes">Yes</option>
		<option value="no">No</option>
		</select>
		</td>
        </tr>		
		<tr id='certificate_status'>
        <td>Certificate:</td>
        <td colspan="2"><input type="text" class="form-control" id="certificate" name="certificate"></td>
		</tr >
		<tr id='validity'>
		<td>Certified From:</td>
        <td colspan="2"><input type="text" class="form-control" id="cer_from" name="cer_from"></td>
		
		<td>Validity:</td>
        <td colspan="2"><input type="date" class="form-control" id="validity" name="validity" onchange="check_date(event)"></td>
		<p class="getDate"></p>
        </tr>
		
		 
        <tr>  
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="resource_formS()" style="float:right;" value="save"></td>
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
            //alert("Your Mobile Number Is Valid.")  
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
            //alert("Your Mobile Number Is Valid.")  
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
 /*   function validation()
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
	   } */
	   
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
//consultant name
function get_consname(value)
{
	alert(value);
if(value==2)
{
//document.getElementById('employee_status').style.visibility = "hidden";
document.getElementById('cname').style.visibility = "visible";
}
else
{
//document.getElementById('employee_status').style.visibility = "visible";
document.getElementById('cname').style.visibility = "hidden";
}
}
$(document).ready (function(){
	document.getElementById('cname').style.visibility = "hidden";

});

//Employeement status
function emp_status(value)
{
	alert(value);
if(value=="Fresher")
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

//certification status
function cer_status1(value)
{
	//alert(value);
 if(value=="yes")
{
document.getElementById('certificate_status').style.visibility = "visible";
document.getElementById('validity').style.visibility = "visible";
}
else
{
document.getElementById('certificate_status').style.visibility = "hidden";
document.getElementById('validity').style.visibility = "hidden";
} 
}

function resource_formS()
{
	var field=1;
	var data = $('form').serialize();
	$.ajax({
		type:'GET',
		data:"field="+field, data,
		url:'/HRMS/HRMS/resource/resource_form/resource_form_submit.php',
		success:function(data)
		{
			if(data==0)
			{
				alert("Form Data has been Submitted ... Hr will contact you please wait");
				//window.location.href="login/logout.php";
				//candidate_form();
				resource_list();
			}
			else
			{
				alert("Form Data has not been Submitted");
				//candidate_form();
				resource_form();
			}	
		}       
	});
}
</script>

<script>
//aadhar number 
$('[data-type="adhaar-number"]').keyup(function() {
  var value = $(this).val();
  value = value.replace(/\D/g, "").split(/(?:([\d]{4}))/g).filter(s => s.length > 0).join("-");
  $(this).val(value);
});

$('[data-type="adhaar-number"]').on("change, blur", function() {
  var value = $(this).val();
  var maxLength = 12;
  if (value.length != maxLength) {
    //$(this).addClass("highlight-error");
	
  } else {
    //$(this).removeClass("highlight-error");
	alert("Invalid aadhar no");
  }
});


//certificate validity

function check_date(e)
{
	var day =e.target.value ;
	var cur= new Date();
	var val= new Date(day);
	 
	  if(val > cur)
	  {
		 // alert("valid");
	  }
	  else{
		  alert("Invalid certificate");
		  $('').val("");
	  }
}
</script>