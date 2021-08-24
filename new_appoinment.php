<?php 
 require("connect.php");
  //require("user.php");
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="colorlib.com">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VMS</title>
	 <link rel="icon" href="../vis.jpg" sizes="30x30" type="image/png">
    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="vendor/nouislider/nouislider.min.css">
    <!-- Main css -->
	<script type="text/javascript" src="webcam.js"></script>
	 <script type="text/javascript" src="<?php echo URL;?>js/jquery.js"></script>
	 <script type="text/javascript" src="<?php echo URL;?>js/jquery.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
	 <!--DatePicker-->   <script src="https://cdn.syncfusion.com/ej2/dist/ej2.min.js"></script>
    <link href="https://cdn.syncfusion.com/ej2/material.css" rel="stylesheet"> <!--DatePicker--> 
	
	<style>
	.actions {
    padding-bottom: 220px;
}
	.content 
	{
	height: auto;
	}
	.button
	{
	 width: 141px;
    position: absolute;
    background: #4966b1;
    margin-left: 839px;
    color: white;
        bottom: 90px;
	}
	.snap
{
    color: white;
    border-radius: 4px;
    text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
    background: rgb(28, 184, 65);
    font-family: inherit;
    font-size: 100%;
    padding: .5em 1em;
	margin-bottom: 15px;
    border: 0 hsla(0, 0%, 0%, 0);
    text-decoration: none;
}
.border
{
    border: 3px rgb(28, 184, 65) solid;
    padding: 0px;
    width: 326px;
    height: 266px;
}
.form-horizontal .control-label{
	padding-top:0px;
}

.box {
    margin-bottom: 1px;
}
.box-footer {
    margin-top: -5px;
}
.form-group {
    margin-bottom: 5px;
}
.logo
		{
			font-size:30px;
		}
th{
	
	text-transform:uppercase;
}
td{
	text-transform:uppercase;
}
	

	</style>
	<script>
webcam.set_api_url( 'upload.php' );
webcam.set_quality( 90 ); // JPEG quality (1 - 100)
webcam.set_shutter_sound( true ); // play shutter click sound

webcam.set_hook( 'onComplete', 'my_completion_handler' );

function take_snapshot() {
// take snapshot and upload to server
document.getElementById('upload_results').innerHTML = 'Snapshot<br>'+
'<img src="uploading.gif">';
webcam.snap();
}

function my_completion_handler(msg) {
// extract URL out of PHP output
if (msg.match(/(http\:\/\/\S+)/)) {
var image_url = RegExp.$1;
// show JPEG image in page
document.getElementById('upload_results').innerHTML = 
'Snapshot<br>' + 
'<a href="'+image_url+'" target"_blank"><img src="' + image_url + '"></a>';

// reset camera for another shot
webcam.reset();
}
else alert("PHP Error: " + msg);
}
</script>
</head>

<body style="background-image:url(../images/banner.jpg);">
<div class="main" style="padding:0px;" >
<header id="header" class="alt">
	<div class="logo" ><a href="../index.php" style="color:white;text-decoration: blink;">ATITHI-Visitor Management System</a></div>	
</header>
	<div class="container" >
	
	<form method="POST" id="signup-form" class="signup-form" action="new_insert.php">
	<div>
	<h3>Personal info</h3>
	<fieldset>
	<h2>Personal information</h2>
	<p class="desc">Please enter your infomation and proceed to next step so we can build your account</p>
	<div class="fieldset-content">
	<div class="form-row">
	<label class="form-label">Name <span style="color:red;">*</span></label>
	<div class="form-flex">
	<div class="form-group">
    <span class="text-input">First</span><span style="color:red;">*</span>
    <input type="text" name="first_name"  style="text-transform:uppercase;" autocomplete="off" onkeyup="getvalue()" id="first_name" required />
	</div>
	<div class="form-group">
	<span class="text-input">Last</span><span style="color:red;">*</span>
	<input type="text" name="last_name" style="text-transform:uppercase;" autocomplete="off" id="last_name" required />
	</div>
	</div>
	</div>
	<div class="form-group">
	<label for="email" class="form-label">Email <span style="color:red;">*</span></label>
	<input type="email" name="email" id="email"  onkeyup="getvalue()" autocomplete="off" required />
	<span class="text-input">Example  :<span>  Jeff@gmail.com</span></span>
	</div>
	<div class="form-group">
	<label for="Mobile " class="form-label">Mobile Number <span style="color:red;">*</span></label>
	<input type="text" name="mobile" id="mobile" style="text-transform:uppercase;" autocomplete="off"  onkeyup="getvalue()" autocomplete="off" placeholder="Enter Mobile Number" required />
	</div>
	
	<div class="form-group">
	<label for="Coming" class="form-label">Coming From <span style="color:red;">*</span></label>
	<input type="text" name="coming" id="coming " style="text-transform:uppercase;" autocomplete="off" placeholder="which company / which place?" required />
	</div>
	<div class="form-group">
	<label for="company" class="form-label">Select Company Name <span style="color:red;">*</span></label>
	<input list="browser" id="company" name="company"style="text-transform:uppercase;" onchange="comp(this.value)" onkeyup="getvalue()" placeholder="Select which company you want to visit" autocomplete="off" required  />
	<datalist id="browser" style="width:30%;"  name="company"  class="" required>

	<?php
	$sql1=mysqli_query($dbhandle, "select * from company_name where status=0");
	while($que=mysqli_fetch_array($sql1))
	{
	?>
	<option  value="<?php echo strtoupper($que['company_name']);?>"><?php echo strtoupper($que['company_name']);?></option>
	<?php
	}
	?>
	</datalist>
	</div>
<div id="personmeet">

</div>
	<div class="form-group">
	<label for="Purpose" class="form-label">Select Purpose of Visit <span style="color:red;">*</span></label>
	<input list="brows1" id="purpose" name="purpose" placeholder="Select visit purpose" style="text-transform:uppercase;" autocomplete="off" required  />
	<datalist id="brows1" style="width:30%;"   name="purpose" class="" required>
	
	<?php
	$sql1=mysqli_query($dbhandle, "select * from  purpose_of_visit where status=0");
	while($que=mysqli_fetch_array($sql1))
	{
	?>
	<option value="<?php echo strtoupper($que['purpose_of_visit']);?>"><?php echo strtoupper($que['purpose_of_visit']);?></option>
	<?php
	}
	?>

	</datalist> 
	</div>
	<div class="form-group">
	<label for="Area of Visit" class="form-label">Select Area of Visit <span style="color:red;">*</span></label>
	<input list="brows2" id="area"  name="area" placeholder="Select visit area" style="text-transform:uppercase;"  autocomplete="off" required />
	<datalist id="brows2" style="width:30%;"  name="area" class=""  required >
	<?php
	$sql1=mysqli_query($dbhandle, "select * from area_of_visit where status=0");
	while($que=mysqli_fetch_array($sql1))
	{
	?>
	<option value="<?php echo strtoupper($que['area_of_visit']);?>"><?php echo strtoupper($que['area_of_visit']);?></option>
	<?php
	}
	?>

	</datalist>
	</div>
	
	</div>
	</fieldset>

	<h3>Vehicle Information</h3>
	<fieldset>
	<label for="phone" class="form-label">Type of Vehicle</label>
	<div class="fieldset-content">
	<input list="brows3" id="type_of_vehicle" name="type_of_vehicle" placeholder="Select Option" autocomplete="off"  required />
	<datalist id="brows3" style="width:30%; margin-bottom:auto; border-radius:1px;" id="" class="form-control "   name="type_of_vehicle"  required >
	<option value=""  required >Select</option>
	<option value="Two Wheeler">Two Wheeler</option>
	<option value="Four Wheeler">Four Wheeler</option>
	<option value="No Vehicle">No Vehicle</option>
	</datalist>
	</div>

	<div class="form-group">
	<label for="vehicle" class="form-label">Vehicle No </label>
	<input style="background-color:white;"  type="text" name="vehicle_no" id="vehicle_no" class="form-control" placeholder="Enter Vehicle No" autocomplete="off" >
	</div>
	
	<div class="form-group">
	<label for="bag" class="form-label">Number of Bags</label>
	<input style="background-color:white;"  type="text" name="no_of_bags" id="no_of_bags" class="form-control" placeholder="Number of Bag You Have?" onkeyup="check(this)" autocomplete="off" >
	</div>
	<div class="form-group">
	<label for="remark" class="form-label">Others/Remarks</label>
	<input style="background-color:white;" type="textarea" name="others_remarks" id="others_remarks" placeholder="Enter Remarks"  class="txtarea" autocomplete="off" >
	</div>
	</fieldset>
	<!--<h3>Take Photo</h3>
	<fieldset>
	<table class="main">
<tr>
<td valign="top" align="right">
<div class="border" align="right">
Live Webcam<br>
<script>
document.write( webcam.get_html(320, 240) );
</script>
<!--embed id="webcam_movie" src="webcam.swf" loop="false" menu="false" quality="best" bgcolor="#ffffff" width="320" height="240" name="webcam_movie" align="middle" allowscriptaccess="always" allowfullscreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="shutter_enabled=1&amp;shutter_url=shutter.mp3&amp;width=320&amp;height=240&amp;server_width=320&amp;server_height=240"--
</div>
<br/><input type="button" class="snap" value="SNAP IT" onClick="take_snapshot()" style="background-color: #18c71d;color: #fbf9f9 !important;">
</td>
<td width="50">&nbsp;</td>
<td valign="top">
<div id="upload_results" class="border">
Snapshot<br>
<img src="logo.jpg" />
</div>
</td>
</tr>--
</table>
	</fieldset>-->
	<h3>Print Pass</h3>
	<fieldset>
	<div style="padding:10px;">
	<img src="../images/quadsel.jpg"/>
	<table>
	<tr>
	<th align="left">name:&nbsp;&nbsp;<span style="color:blue;"  id="name_fix"></span></th>
	</tr>
	<tr>
	<th align="left">Email ID:&nbsp;&nbsp;<span style="color:blue;"  id="email_fix"></span></th>
	</tr>
	<tr>
	<th align="left">Visitor Contact Number:&nbsp;&nbsp;<span style="color:blue;" id="mobile_fix"></span></th>
	</tr>
	<tr>
	<th align="left">Visitor's Company Details:&nbsp;&nbsp;<span style="color:blue;"  id="company_fix"></span></th>
	</tr>
	</table>
	
	 	<input type="submit" style="margin-left:130px;margin-top:350px;"  name="submit" value="Click here" onclick="appoinment(12); sms(11);" class="button"/>
	    

	</fieldset>

	</div>
	</form>
	</div>
	</div>
	

	<!-- JS -->
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/jquery-validation/dist/jquery.validate.min.js"></script>
	<script src="vendor/jquery-validation/dist/additional-methods.min.js"></script>
	<script src="vendor/jquery-steps/jquery.steps.min.js"></script>
	<script src="vendor/minimalist-picker/dobpicker.js"></script>
	<script src="vendor/nouislider/nouislider.min.js"></script>
	<script src="vendor/wnumb/wNumb.js"></script>
	<script src="js/main.js"></script>
	
	
	</body>	
	
	<script>
	function comp(d)

	{
	   // alert(d);
            var scn=$('#company').val();
	$.ajax({
			type: "POST",
			url: "get_person.php",
			data :"id="+scn,
		success: function(data)
			{
				$('#personmeet').html(data);
			}
			});
}
	</script>
	<script>
	function getvalue()
	{
		
		var fname=document.getElementById("first_name").value;
		var lname=document.getElementById("last_name").value;
		var email=document.getElementById("email").value;
		 var mobile=document.getElementById("mobile").value;
		var company=document.getElementById("company").value;
		var person=document.getElementById("person").value;
		var name=fname+lname;
		//var date=document.getElementById("birth_date").value;
	
		// alert(name);
		document.getElementById('name_fix').innerHTML = name;
		document.getElementById('email_fix').innerHTML = email;
		 document.getElementById('mobile_fix').innerHTML = mobile;
		document.getElementById('company_fix').innerHTML = company;
		document.getElementById('person_fix').innerHTML = person;
		//document.getElementById('date_fix').innerHTML = date;
		
	 
	}
	</script>
	
<script type="text/javascript"> 

function stopRKey(evt) { 
  var evt = (evt) ? evt : ((event) ? event : null); 
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;} 
} 

document.onkeypress = stopRKey; 

</script>

<script>
function appoinment(code)
{
	//alert("you have clicked");
	var first_name=$('#first_name').val();
	var last_name=$('#last_name').val();
	var email=$('#email').val();
	var mobile=$('#mobile').val();
	//var mobile=$('#mobile').val();
	var company=$('#company').val();
	var person=$('#person').val();
	//alert(person);
	var full_name=first_name+last_name;
	$.ajax({ 
	    type: 'get',
		data: 'full_name='+full_name+'&email='+email+'&mobile='+mobile+'&company='+company+'&person='+person,
		url : 'reply_mail.php',
        success: function(data){
			
         
		}
	 });
} 

/* function sms(code)
{ 
    // alert("Wait a moment..!then click Ok ");
	var first_name=$('#first_name').val();
	var last_name=$('#last_name').val();
	var email=$('#email').val();
	var mobile=$('#mobile').val();
	//var mobile=$('#mobile').val();
	var company=$('#company').val();
	var purpose=$('#purpose').val();
	var person=$('#person').val();
	//alert(person);
	var full_name=first_name+last_name;
	
	$.ajax({ 
	    type: 'get',
		data: 'full_name='+full_name+'&email='+email+'&mobile='+mobile+'&company='+company+'&person='+person+'&purpose='+purpose,
		url : 'smsval.php',
        success: function(data){
         
		}
	 });
}  */
</script>



<script type="text/javascript">

$(document).ready(function () {
    $(".submitBtn").click(function () {
        $(".submitBtn").attr("disabled", true);
        return true;
    });
	//$('#divhide').hide;
});
</script>
<script type="text/javascript">
						window.onbeforeunload = function () {
							jQuery("input[type=submit]").attr("disabled");
						};
					</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
</html>

