<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];

?>
<div class="card card-info">
              <div class="card-header">
                
				              <center><h3 class="card-title"><b>Password Name</b></h3></center>
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
        <td> Name</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter name" id="password_name" name="password_name"></td>
        </tr>
      
		
       
		
		
		
		 
		
		
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="insert_pass()" value="save"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>

			<script>
			 function insert_pass()
    {
    var id=0;
	//alert(id);
    var data = $('form').serialize();
//alert(data);
    $.ajax({
    type:'POST',
    data:"id="+id, data,
	url:"HRMS/password/password_master/password_submit.php",
  
    success:function(data)
    {      
        alert("Entry Successfully");
		password_masters()
		          
    }       
    });
    }
	function back()
	
	{
		password_masters()


	}
	</script>