<?php
require '../../connect.php';
require '../../user.php';
$candidateid=$_SESSION['candidateid'];
$sql=$con->query("select * from candidate_form_details  
INNER JOIN designation_master ON candidate_form_details.position = designation_master.id where candidate_form_details.id='$candidateid'");
//echo "select * from candidate_form_details  where id='$candidateid'";
$data=$sql->fetch();
?>
<div class="content-wrapper" style="padding-left: 50px;">
   <section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header p-2">
<ul class="nav nav-pills">
<li class="nav-item"><a class="nav-link active" href="#for_employment" data-toggle="tab">Application for Employment</a></li>
<li class="nav-item"><a class="nav-link" href="#education_qualification" data-toggle="tab">Educational Qualifications</a></li>
<li class="nav-item"><a class="nav-link" href="#certification_details" data-toggle="tab">Certification Details</a></li>
<li class="nav-item"><a class="nav-link" href="#employment_details" data-toggle="tab">Employment Details</a></li>
</ul>
</div><!-- /.card-header -->
<div class="card-body">
<div class="tab-content">
    <div class="active tab-pane" id="for_employment">
    <form class="form-horizontal" method="POST" action="Recruitment/Recruitment/submit.php" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
        <tr>
        <td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
        <td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
        </tr>
        <tr>
        <td colspan="6"><center><b>Application for Employment</b></center></td>
        </tr>
        <tr>
        <td>Post Applied for:</td>
        <td colspan="5"><input type="text" class="form-control" id="position" name="position" value="<?php echo $data['designation_name'];?>"  ></td>
        </tr>
        <tr>
        <td colspan="6"><center><b>Personal Details</b></center></td>
        </tr>
        <tr>
        <td>Name of the candidate:</td>
        <td colspan="5"><input type="text" class="form-control" id="candidate_name" name="candidate_name" value="<?php echo $data['first_name'].".". $data['last_name'];?>" ></td>
        </tr>
        <tr>
        <td>Father's Name:</td>
        <td colspan="5"><input type="text" class="form-control" id="father_name" name="father_name" value="<?php echo $data['father_name'];?>"  ></td>
        </tr>
        <tr>
        <td>Date of Birth:</td>
        <td colspan="5"><input type="date" class="form-control" id="dob" name="dob" value="<?php echo $data['dob'];?>" ></td>
        </tr>
        <tr>
        <td>Address Communication:</td>
        <td colspan="5"><input type="text" class="form-control" id="address" name="address" value="<?php echo $data['address'];?>"  ></td>
        </tr>
        <tr>
        <td>Permanent Address:</td>
        <td colspan="5"><input type="text" class="form-control" id="paddress" name="paddress" value="<?php echo $data['paddress'];?>" ></td>
        </tr>
        <tr>
        <td>Telephone no. (Mobile/others):</td>
        <td colspan="5"><input type="text" class="form-control" id="phone" name="phone" value="<?php echo $data['phone'];?>" ></td>
        </tr>
        <tr>
        <td>Category (Email ID if any):</td>
        <td colspan="5"><input type="text" class="form-control" id="mail" name="mail" value="<?php echo $data['mail'];?>" ></td>
        </tr>
        <tr>
        <td>Aadhar Number:</td>
        <td colspan="4"><input type="text" class="form-control" id="adharnumber" name="adharnumber" value="<?php echo $data['adharnumber'];?>" ></td>
                <td colspan="4"><input type="file" class="form-control" id="adharupload" name="adharupload" ></td>
       
	   </tr>
		 
        <tr>
        <td>Pan Number:</td>
        <td colspan="4"><input type="text" class="form-control" id="pannumber" name="pannumber" value="<?php echo $data['pannumber'];?>"></td>
        <td colspan="1"><input type="file" class="form-control" id="panupload" name="panupload" ></td>
       
	   </tr>
		
        <tr>
        <td>Voter ID:</td>
        <td colspan="4"><input type="text" class="form-control" id="voternumber" name="voternumber" value="<?php echo $data['voternumber'];?>" ></td>
                <td colspan="1"><input type="file" class="form-control" id="votercardupload" name="votercardupload" ></td>

		</tr>
		
        <tr>
        <td>Resume:</td>
        <td colspan="5"><input type="file" class="form-control" id="resume" name="resume"></td>
        </tr>
        <tr>  
        <td colspan="6">
		<input type="hidden" name="cid" id="cid" value="<?php echo $candidateid;?>">
		<button type="submit" class="btn btn-primary" name="save" class="btn btn-primary">Save</button></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>

    <script>
    function employee_personal()
    {
    var id=0;
    var data = $('form').serialize();
	alert(data);
    $.ajax({
    type:'GET',
    data:"id="+id, data,
    url:'/Recruitment_backup/Recruitment/Recruitment/employee_personal_insert.php',
    success:function(data)
    {
      if(data!='')
      { 
        alert('Entry Successfully');
       // add_employee()
      }
      else
      {
        alert("No Data choose");
      }
      
    }       
    });
    }
    </script>

    <div class="tab-pane" id="education_qualification">
	<form class="form-horizontal" method="POST"   action="Recruitment/Recruitment/employee_educational_insert.php" enctype="multipart/form-data">
    <table class="table table-bordered" id="new_tab">
    <tr>
    <td colspan="6"><center><b>Educational Qualifications (In descending order of qualifications attained)</b></center></td>
    </tr>
    <tr>
      <th>#</th>
      <th>Education</th>
      <th>Name of Institution/University</th>
      <th>Degree</th>
      <th>Field of Specialization</th>
      <th>Year of Passing</th>
      <th>Percentage</th>
      <th>Attachement</th>
    </tr>
    
    
    <tr>
      <td><input type="checkbox" class="chk" name="chk[]" id="chk_1" value="1" style="width:15px;height:20px;"/></td>
      <td><input type="text" class="form-control" id="Examination_passed_1" name="examination_passed[]"></td>
      <td><input type="text" class="form-control" id="instute_1" name="instute[]"></td>
      <td><input type="text" class="form-control" id="degree_1" name="degree[]"></td>
      <td><input type="text" class="form-control" id="field_1" name="field[]"></td> 	
      <td><input type="text" class="form-control" id="passing_1" name="passing[]"></td>
      <td><input type="text" class="form-control" id="percentage_1" name="percentage[]"></td>
      <td><input type="file" class="form-control" id="attachment_1" name="attachment[]"></td>
      <td><input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check()" value="Add">
      <input type="button" class="btn btn-danger" id="certificate_row_remove"  value="Remove">
    </td>
    </tr>
   
    
    </table>
    <table>
    <tr> <td colspan="6">
		<input type="hidden" name="cid" id="cid" value="<?php echo $candidateid;?>">
		<button type="submit" name="save" class="btn btn-primary">Save</button></td></tr>
    </table>
    </form>
    <!-- /.tab-pane -->
    </div>
    <script>
    function check() // education
    {
    var len=$('#new_tab tr').length;	
    len=len+1; 
    $('#new_tab').append('<tr class="row_'+len+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len+'" value="'+len+'"</td><td><input type="text" class="form-control" id="Examination Passed_'+len+'" name="examination_passed[]"></td><td><input type="text" class="form-control" id="instute_'+len+'" name="instute[]"></td><td><input type="text" class="form-control" id="degree_'+len+'" name="degree[]"></td><td><input type="text" class="form-control" id="field_'+len+'" name="field[]"></td><td><input type="text" class="form-control" id="passing_'+len+'" name="passing[]"></td><td><input type="text" class="form-control" id="percentage_'+len+'" name="percentage[]"></td><td><input type="file" class="form-control" id="attachment_'+len+'" name="attachment[]"></td></tr>'); 
    }



    $('#certificate_row_remove').click(function(){
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
	<script>

    function emp_education_save()
    {
      
      var pass = [];
      var passed = document.getElementsByName('examination_passed[]');
      for (var i = 0; i < passed.length; i++) { 
      var a = passed[i]; 
      pass.push(a.value); 
      } 

      var ins = [];
      var instute = document.getElementsByName('instute[]');
      for (var i = 0; i < instute.length; i++) { 
      var a = instute[i]; 
      ins.push(a.value); 
      } 

      var degrees = [];
      var degr = document.getElementsByName('degree[]');
      for (var i = 0; i < degr.length; i++) { 
      var a = degr[i]; 
      degrees.push(a.value); 
      }
      

      var field = [];
      var fields = document.getElementsByName('field[]');
      for (var i = 0; i < fields.length; i++) { 
      var a = fields[i]; 
      field.push(a.value); 
      }
      
      var passing = [];
      var passi = document.getElementsByName('passing[]');
      for (var i = 0; i < passi.length; i++) { 
      var a = passi[i]; 
      passing.push(a.value); 
      }

      var percent = [];
      var percentage = document.getElementsByName('percentage[]');
      for (var i = 0; i < percentage.length; i++) { 
      var a = percentage[i]; 
      percent.push(a.value); 
      }

       var attach = [];
      var attachment = document.getElementsByName('attachment[]');      
      for (var i = 0; i < attachment.length; i++) { 
        var a = attachment[i]; 
        attach.push(a.value); 
      } 

   // var attachment = document.getElementsByName('attachment[]');     
    alert(attach);
	
	  $.ajax({
	type:"POST",
	data:"pass="+pass+"&ins="+ins+"&degrees="+degrees+"&field="+field+"&passing="+passing+"&percent="+percent+"&attach="+attach,            
//	url:'/Recruitment/Recruitment/Recruitment/employee_educational_insert.php',
	 url:"/Recruitment_backup/Recruitment/Recruitment/employee_educational_insert.php",
	success:function(data)
	{
		//$('#table_view').html(data);
	}
	})
		
	
    
    }
    </script>
	
	<?php
	if(isset($_POST['edu_save']))
{
	echo "hii";
	foreach($_FILES["attachment"]["tmp_name"] as $key=>$tmp_name) {
 $file_name=$_FILES["attachment"]["name"][$key];
  //$file_name=$file;
  echo  $file_tmp=$_FILES["attachment"]["tmp_name"][$key];
    $ext=pathinfo($file_name,PATHINFO_EXTENSION);
	}
}
	?>
   <div class="tab-pane" id="certification_details">
       <form method="POST" id="emp_education" action="Recruitment/Recruitment/employee_certificate_insert.php" enctype="multipart/form-data">

    <table class="table table-bordered" id="new_tab1">
	
    <tr>
    <td colspan="6"><center><b>Certification Details</b></center></td>
    </tr>
    <tr>
      <th>#</th>
      <th>Certification Name:</th>
      <th>Certification Number:</th>
      <th>Validity From:</th>
      <th>Validity To:</th>
	  <th>Attachement</th>
    </tr>
    
    <tr>
      <td><input type="checkbox" class="chk" name="chk[]" id="chk_1" value="1" style="width:15px;height:20px;"/></td>
     <td><input type="text" class="form-control" id="certifcatename_1" name="certifcatename[]"></td>
      <td><input type="text" class="form-control" id="certifcatnumber_1" name="certifcatenumber[]"></td>
      <td><input type="date" class="form-control" id="validityfrom_1" name="validityfrom[]"></td>
      <td><input type="date" class="form-control" id="validityto_1" name="validityto[]"></td>
      <td><input type="file" class="form-control" id="certifcatefile_1" name="certifcatefile[]"></td>
      <td><input type="button" class="btn btn-success" id="new_row1" name="new_row1" onclick="check1()" value="Add">
      <input type="button" class="btn btn-danger" id="certificate_row1_remove" onclick="certificate_row1_remove()" value="Remove">
    </td>
    </tr>   
     </table>
    <table>
    <tr><td><input type="hidden" name="cid" id="cid" value="<?php echo $candidateid;?>">
	<button type="submit" name="edu_save" value="save" class="btn btn-primary">Save</button></td></tr>
    </table>
    </form>
    <!-- /.tab-pane -->
    </div>
    <!-- /.tab-pane -->
	<script>
	function check1() // Certificate
	{
	var len1=$('#new_tab1 tr').length;	
	len1=len1+1; 
	$('#new_tab1').append('<tr class="row_'+len1+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len1+'" value="'+len1+'"</td><td colspan="1"><input type="text" class="form-control" id="certifcatename_'+len1+'" name="certifcatename[]"></td><td colspan="1"><input type="text" class="form-control" id="certifcatenumber'+len1+'" name="certifcatenumber[]"></td><td colspan="1"><input type="date" class="form-control" id="validityfrom_'+len1+'" name="validityfrom[]"></td><td colspan="1"><input type="date" class="form-control" id="validityto_'+len1+'" name="validityto[]"></td><td colspan="1"><input type="file" class="form-control" id="certifcatefile_'+len1+'" name="certifcatefile[]"></td></tr>'); 
	}

    $('#certificate_row1_remove').click(function(){
    $('input:checkbox:checked.chk').map(function(){
    var idd=$(this).val();
    var lee=$('#new_tab1 tr').length;

    if(lee==1)
    {
    alert("You Can't Delete All the Rows");
    }
    else
    {
    $('.row_'+idd).remove();
    }

    });
    });
</script>
<script>
	 function emp_certificate_save()
    {
      alert('ok');
      
      var name = [];
      var cname = document.getElementsByName('certifcatename[]');
      for (var i = 0; i < cname.length; i++) { 
      var a = cname[i]; 
      name.push(a.value); 
      } 

      var num = [];
      var cnumber = document.getElementsByName('certifcatenumber[]');
      for (var i = 0; i < cnumber.length; i++) { 
      var a = cnumber[i]; 
      num.push(a.value); 
      } 

      var validity = [];
      var vfrom = document.getElementsByName('validityfrom[]');
      for (var i = 0; i < vfrom.length; i++) { 
      var a = vfrom[i]; 
      validity.push(a.value); 
      }
      

      var valto = [];
      var vto = document.getElementsByName('validityto[]');
      for (var i = 0; i < vto.length; i++) { 
      var a = vto[i]; 
      valto.push(a.value); 
      }
	}
	 var attach = [];
      var attachment = document.getElementsByName('attachment[]');      
      for (var i = 0; i < attachment.length; i++) { 
        var a = attachment[i]; 
        attach.push(a.value); 
      }

    alert(percent);
	var id=1;
	
	  $.ajax({
	type:"POST",
	data:"name="+name+"&num="+num+"&validity="+validity+"&valto="+valto+"&attach="+attach,            
//	url:'/Recruitment/Recruitment/Recruitment/employee_educational_insert.php',
	 url:"/Recruitment_backup/Recruitment/Recruitment/employee_certificate_insert.php?id="+id,
	success:function(data)
	{
		//$('#table_view').html(data);
	}
	})
		
	
    
    }
    </script>

    <div class="tab-pane" id="employment_details">
	       <form method="POST" id="emp_education" action="Recruitment/Recruitment/employee_employment_insert.php" enctype="multipart/form-data">

    <table class="table table-bordered" id="new_tab2">
    <tr>
    <td colspan="10"><center><b>Employment Details</b></center></td>
    </tr>
    <tr>
	<th>#</th>
    <th>Name of the Organization</th>
    <th colspan="2">Designation (With Specific field Mentioned where Worked/working)</th>
    <th>From</th>
    <th>To</th>
    <th>Total Years of Experience</th>
    </tr>
    <tr>
	<td><input type="checkbox" class="chk" name="chk[]" id="chk_1" value="1" style="width:15px;height:20px;"/></td>
    <td><input type="text" class="form-control" id="organization_1" name="organization[]"></td>
    <td colspan="2"><input type="text" class="form-control" id="Designation_1" name="designation[]"></td>
    <td><input type="date" class="form-control" id="From_1" name="from[]"></td>
    <td><input type="date" class="form-control" id="to_1" name="to[]"></td>
    <td><input type="text" class="form-control" id="yearofexperience_1" name="yearofexperience[]" ></td>
    <td><input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check2()" value="Add">
	   <input type="button" class="btn btn-danger" id="certificate_row2_remove" onclick="certificate_row2_remove()" value="Remove"></td>
    </tr>

    </table>
    <table class="table table-bordered">
    <tr>		
    <td> Overall Experience :</td>
    <td colspan="5"><input type="text" class="form-control" id="overallexp" name="overallexp"></td>
    </tr>
    </table>
    <table class="table table-bordered">
    <tr>		
    <td> Reference Name & Number :</td>
    <td colspan="5"><input type="text" class="form-control" id="reference" name="reference"></td>
    </tr>
    <tr>		
    <td>Signature:</td>
    <td colspan="5"><input type="text" class="form-control" id="signature" name="signature"></td>
    </tr>
    <tr>		
    <td>Date:</td>
    <td colspan="5"><input type="date" class="form-control" id="interview_date" name="interview_date"></td>
    </tr>
    </table>
		 <tr><td><input type="hidden" name="cid" id="cid" value="<?php echo $candidateid;?>">
	<button type="submit" name="edu_save" value="save" class="btn btn-primary">Save</button></td></tr>
  </form>
    </div>
    <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
    </div><!-- /.card-body -->
    </div>
    <!-- /.nav-tabs-custom -->
    </>
    <!-- /.col -->
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
    </section>
		<script>
function check2() // Experience
{
	var len2=$('#new_tab2 tr').length;	
	len2=len2+1; 
	$('#new_tab2').append('<tr class="row_'+len2+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len2+'" value="'+len2+'"></td><td><input type="text" class="form-control" id="organization_'+len2+'" name="organization[]"></td><td colspan="2"><input type="text" class="form-control" id="Designation_'+len2+'" name="designation[]"></td><td><input type="date" class="form-control" id="From_'+len2+'" name="from[]"></td><td><input type="date" class="form-control" id="to_'+len2+'" name="to[]"></td><td colspan="1"><input type="text" class="form-control" id="yearofexperience_'+len2+'" name="yearofexperience[]" ></td></tr>'); 
}
 $('#certificate_row2_remove').click(function(){
    $('input:checkbox:checked.chk').map(function(){
    var id1=$(this).val();
    var le1=$('#new_tab1 tr').length;

    if(le1==1)
    {
    alert("You Can't Delete All the Rows");
    }
    else
    {
    $('.row_'+id1).remove();
    }

    });
    });
	</script>
	<script>
	
	function emp_details_save()
    {
      alert('ok');
      
      var organiz = [];
      var organizat = document.getElementsByName('organization[]');
      for (var i = 0; i < organizat.length; i++) { 
      var a = organizat[i]; 
      organiz.push(a.value); 
      } 

      var designat = [];
      var design = document.getElementsByName('designation[]');
      for (var i = 0; i < design.length; i++) { 
      var a = design[i]; 
      designat.push(a.value); 
      } 

      var valfrom = [];
      var vafrom = document.getElementsByName('from[]');
      for (var i = 0; i < vafrom.length; i++) { 
      var a = vafrom[i]; 
      valfrom.push(a.value); 
      }
    

      var too = [];
      var vato = document.getElementsByName('to[]');
      for (var i = 0; i < vato.length; i++) { 
      var a = vato[i]; 
      too.push(a.value); 
      }
	  
	   var exp = [];
      var experienc = document.getElementsByName('yearofexperience[]');
      for (var i = 0; i < experienc.length; i++) { 
      var a = experienc[i]; 
      exp.push(a.value); 
      }
	  
	   var refer = [];
      var referenc = document.getElementsByName('reference');
      for (var i = 0; i < referenc.length; i++) { 
      var a = referenc[i]; 
      refer.push(a.value); 
      }
	  
	   var sign = [];
      var signatur = document.getElementsByName('signature');
      for (var i = 0; i < signatur.length; i++) { 
      var a = signatur[i]; 
      sign.push(a.value); 
      }
	  
	   var date = [];
      var interview = document.getElementsByName('interview_date');
      for (var i = 0; i < interview.length; i++) { 
      var a = interview[i]; 
      date.push(a.value); 
      }
	  
	}
	</script>

    <!--script>

  
 function check1() // Certificate
	{
	var len1=$('#new_tab1 tr').length;	
	len1=len1+1; 
	$('#new_tab1').append('<tr class="row_'+len1+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len1+'" value="'+len1+'"</td><td colspan="1"><input type="text" class="form-control" id="certifcatename_'+len1+'" name="certifcatename[]"></td><td colspan="1"><input type="text" class="form-control" id="certifcatenumber'+len1+'" name="certifcatenumber[]"></td><td colspan="1"><input type="date" class="form-control" id="validityfrom_'+len1+'" name="validityfrom[]"></td><td colspan="1"><input type="date" class="form-control" id="validityto_'+len1+'" name="validityto[]"></td><td colspan="1"><input type="file" class="form-control" id="certifcatefile_'+len1+'" name="certifcatefile[]"></td></tr>'); 
	}

    $('#certificate_row1_remove').click(function(){
    $('input:checkbox:checked.chk').map(function(){
    var idd=$(this).val();
    var lee=$('#new_tab1 tr').length;

    if(lee==1)
    {
    alert("You Can't Delete All the Rows");
    }
    else
    {
    $('.row_'+idd).remove();
    }

    });
    });

    function emp_certificate_save()
    {
      alert('ok');
      
      var name = [];
      var cname = document.getElementsByName('certifcatename[]');
      for (var i = 0; i < cname.length; i++) { 
      var a = cname[i]; 
      name.push(a.value); 
      } 

      var num = [];
      var cnumber = document.getElementsByName('certifcatenumber[]');
      for (var i = 0; i < cnumber.length; i++) { 
      var a = cnumber[i]; 
      num.push(a.value); 
      } 

      var validity = [];
      var vfrom = document.getElementsByName('validityfrom[]');
      for (var i = 0; i < vfrom.length; i++) { 
      var a = vfrom[i]; 
      validity.push(a.value); 
      }
      

      var valto = [];
      var vto = document.getElementsByName('validityto[]');
      for (var i = 0; i < vto.length; i++) { 
      var a = vto[i]; 
      valto.push(a.value); 
      }
	}
    
function check2() // Experience
{
	var len2=$('#new_tab2 tr').length;	
	len2=len2+1; 
	$('#new_tab2').append('<tr class="row_'+len2+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len2+'" value="'+len2+'"></td><td><input type="text" class="form-control" id="organization_'+len2+'" name="organization[]"></td><td colspan="2"><input type="text" class="form-control" id="Designation_'+len2+'" name="Designation[]"></td><td><input type="date" class="form-control" id="From_'+len2+'" name="From[]"></td><td><input type="date" class="form-control" id="to_'+len2+'" name="to[]"></td><td colspan="1"><input type="text" class="form-control" id="yearofexperience_'+len2+'" name="yearofexperience[]" ></td></tr>'); 
}
 $('#certificate_row2_remove').click(function(){
    $('input:checkbox:checked.chk').map(function(){
    var id1=$(this).val();
    var le1=$('#new_tab1 tr').length;

    if(le1==1)
    {
    alert("You Can't Delete All the Rows");
    }
    else
    {
    $('.row_'+id1).remove();
    }

    });
    });

    function emp_certificate_save()
    {
      alert('ok');
      
      var organiz = [];
      var organizat = document.getElementsByName('organization[]');
      for (var i = 0; i < organizat.length; i++) { 
      var a = organizat[i]; 
      organiz.push(a.value); 
      } 

      var designat = [];
      var design = document.getElementsByName('designation[]');
      for (var i = 0; i < design.length; i++) { 
      var a = design[i]; 
      designat.push(a.value); 
      } 

      var valfrom = [];
      var vafrom = document.getElementsByName('from[]');
      for (var i = 0; i < vafrom.length; i++) { 
      var a = vafrom[i]; 
      valfrom.push(a.value); 
      }
    

      var too = [];
      var vato = document.getElementsByName('to[]');
      for (var i = 0; i < vato.length; i++) { 
      var a = vato[i]; 
      too.push(a.value); 
      }
	  
	   var exp = [];
      var experienc = document.getElementsByName('yearofexperience[]');
      for (var i = 0; i < experienc.length; i++) { 
      var a = experienc[i]; 
      exp.push(a.value); 
      }
	  
	   var refer = [];
      var referenc = document.getElementsByName('reference');
      for (var i = 0; i < referenc.length; i++) { 
      var a = referenc[i]; 
      refer.push(a.value); 
      }
	  
	   var sign = [];
      var signatur = document.getElementsByName('signature');
      for (var i = 0; i < signatur.length; i++) { 
      var a = signatur[i]; 
      sign.push(a.value); 
      }
	  
	   var date = [];
      var interview = document.getElementsByName('interview_date');
      for (var i = 0; i < interview.length; i++) { 
      var a = interview[i]; 
      date.push(a.value); 
      }
	  
	}
  </script-->
<script> 
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
    </script> 
	<script>
$(document).ready(function(){
  $(".application").click(function(){
	  alert('application form successfully saved');
    
	 $("#education_qualification").show();
  });
});
</script>

