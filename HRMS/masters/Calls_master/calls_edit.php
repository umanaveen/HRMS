<?php
require '../../../connect.php';
include("../../../user.php");
 $id=$_REQUEST['id'];

$stmt = $con->prepare("SELECT * FROM `calls_master` WHERE id='$id'"); 
$stmt->execute(); 
$row = $stmt->fetch();

?>
<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header">
<i class="fa fa-table"></i>calls Edit
<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a>
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
        <td colspan="6"><center><b>Edit calls</b></center></td>
        </tr>
		
        
		
     
        <tr>
       <td>calls Name</td>
	   <input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $row['id']; ?>">
        <td colspan="5"><input type="text" class="form-control" name="calls" id="calls" value="<?php echo  $row['name'];?>" ></td>
        </tr>
       
        
		

	
	
		<tr>
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="calls()" value="save"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>

    <script>
    function calls()
    {
    var id=0;
	alert(id);
    var data = $('form').serialize();
alert(data);
    $.ajax({
    type:'GET',
    data:"id="+id, data,
     url:"HRMS/masters/Calls_master/calls_update.php",
    success:function(data)
    {      
        alert("Entry Successfully");
	 calls_master()
		          
    }       
    });
    }
	
	function back()
	
	{
 calls_master()

	}

    </script>
