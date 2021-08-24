<?php
require '../../../connect.php';
include("../../../user.php");
 $id=$_REQUEST['id'];

$stmt = $con->prepare("SELECT * FROM `service_master` WHERE service_id='$id'"); 
$stmt->execute(); 
$row = $stmt->fetch();

?>
<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header">
<i class="fa fa-table"></i>Service Edit
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus"></i>Back</a>
</div>
<div class="card-body">
<div class="tab-content">

    <div class="active tab-pane" id="for_employment">
    <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
        <tr>
        <td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
        <td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
        </tr>
      
        <tr>
        <td colspan="6"><center><b>Edit Service</b></center></td>
        </tr>
		
        
		
     
        <tr>
       <td>Service Name</td>
	   <input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $row['service_id']; ?>">
        <td colspan="5"><input type="text" class="form-control" name="service_name" id="service_name" value="<?php echo  $row['service_name'];?>" ></td>
        </tr>
       
        
		

	
	
		<tr>
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="service()" value="save"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>

    <script>
    function service()
    {
    var id=0;
	//alert(id);
    var data = $('form').serialize();
//alert(data);
    $.ajax({
    type:'GET',
    data:"id="+id, data,
     url:"HRMS/masters/Service_master/service_update.php",
    success:function(data)
    {      
        alert("Entry Successfully");
	 service_master()
		          
    }       
    });
    }
	
	

    </script>
