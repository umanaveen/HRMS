<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
$con_id=$_REQUEST['id'];
$sql=$con->query("select * from consultant_master where consultant_id='$con_id'");
echo "select * from consultant_master where id='$con_id'";
$cfet=$sql->fetch();
?>
<!--div class="container-fluid"-->
<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">New Consultant</font></h3>
			<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
				
              </div>


<form method="POST" action="">
<table class="table table-bordered">

       <tr>
        <td><center><img src="/HRMS/HRMS/Recruitment/image/userlog/bluebase.png"  style="width:300px;height:150px;"></center></td>
        <td colspan="5"><center><h1><b>Bluebase Software services Pvt Ltd</b></h1></center></td>
        </tr>
       
        
       
         
	  <tr>
       <td>Consultant Name</td>
	   
        <td colspan="5">
		<input type="hidden" name="con_id" id="con_id"  value="<?php echo $con_id;?>">
		<input type="text" class="form-control" placeholder="Consultant Name" id="C_name" name="C_name" value="<?php echo $cfet['consultant_name'];?>"></td>
        </tr>
        
        
         <tr>
        <td>Consultant Organization Name</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Consultant Organization Name"  name="org_name" id="org_name"value="<?php echo $cfet['con_org'];?>"></td>
        </tr>
		 <tr>
        <td>Mobile Number: *</td>
        <td colspan="5"><input type="text" class="form-control" id="phone" name="phone" onchange="CheckIndianNumber(this.value)" placeholder="+91" value="<?php echo $cfet['phn_no'];?>"></td>
        </tr>
        
        <tr>
        <td>Alternate Mobile Number: </td>
        <td colspan="5"><input type="text" class="form-control" id="whatsapp" name="whatsapp" value="<?php echo $cfet['alt_phno'];?>" onchange="CheckIndianNumber1(this.value)" placeholder="+91"></td>
        </tr>
        <tr>
        <td>Email ID : *</td>
        <td colspan="5"><input type="text" class="form-control" id="mail" name="mail" value="<?php echo $cfet['email'];?>" onchange="ValidateEmail(this.value)"></td>
        </tr>
              
		<tr>
        <td>Alternate Email ID : </td>
        <td colspan="5"><input type="text" class="form-control" id="alt_mail" name="alt_mail" value="<?php echo $cfet['alt_email'];?>"  onchange="ValidateEmail1(this.value)"></td>
        </tr>
        <tr>
        <td>Percentage</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Consultant Percentage" id="Percentage" value="<?php echo $cfet['percentage'];?>" name="Percentage"></td>
        </tr>
        <tr>
        <td>Status:</td>
        <td colspan="4">	
		<select class="form-control" id="cer_status" name="cer_status" required>
		<option value="">Choose  Status</option>
		<option value="1">Active</option>
		<option value="2">In Active</option>
		</select>
		</td>
        </tr>	
		<td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="update_contract()" value="save"></td>
        </tr>
        </table>
</form>
</div>
<script>
		function back()
    {
 consultant_master()
  }
</script>
  <script>
  $(document).ready(function() {
$('#code').on('change', function() {
var code = this.value;
//alert(code);
$.ajax({
url: "HRMS/user_role/find_role.php",
type: "get",
data: {
code: code
},
cache: false,
success: function(data){
	//alert(data);
var split=data.split("=");
//alert(split[0]);

$('#role_code').val(split[0]);

//alert(split[1]);
}
});

});

});
    function update_contract()
    {
    var id=0;
    var data = $('form').serialize();
	//alert(data);
    $.ajax({
    type:'GET',
    data:"id="+id, data,
	url:"HRMS/consultant_master/consultant_update.php",
    success:function(data)
    {
      if(data!='0')
      { 
         alert("No Data choose");
     consultant_master()
      }
      else
      {
      
		 alert('Entry Successfully');
		consultant_master()
      }
      
    }       
    });
    }
	
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
  function ValidateEmail1(email) 
	 {
		 var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            //var address = document.getElementById[email].value;
            if (reg.test(email) == false) 
            {
                alert('Invalid Email Address');
                //return (false);
				$('#alt_mail').val('');
            }
 }
    </script>
