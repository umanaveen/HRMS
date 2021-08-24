<?php
require '../../connect.php';
include("../../user.php");
 $id=$_REQUEST['id'];

$stmt = $con->prepare("SELECT * FROM `Enquiry` WHERE id='$id'"); 
$stmt->execute(); 
$row = $stmt->fetch();

?>
<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header">
<i class="fa fa-table"></i> 
<center><h3 class="card-title"><b>Lead Edit </b></h3></center>
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger">Back</a>
</div>
<br>
<br>

<div class="card-body">
<div class="tab-content">

    <div class="active tab-pane" id="for_employment">
    <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
        <tr>
         <td><center><img src="/HRMS/HRMS/Recruitment/image/userlog/bluebase.png"  style="width:300px;height:150px;"></center></td>
    <td colspan="5"><center><h1><b>Bluebase Software services Pvt Ltd</b></h1></center></td>
        </tr>
      
        <tr>
        <td colspan="6"><center><b>Edit Lead</b></center></td>
        </tr>
		
        
		
        
        <tr>
		<td>Product:</td>
		<td colspan="5">
		 <input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $row['id']; ?>">
		<select class="form-control" id="product" name="product">
		
		<option value="1">Product</option>
		<option value="2">Solution</option>
		</select></td>
        </tr>
       
        
        
        
		
      
		
		
		
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="update_proposal()" value="save"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>

    <script>
     function update_proposal()
    {
    var id=$('#get_id').val();
	//alert(id);
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data:"id="+id, data,
    url:'HRMS/CRM/update_proposal.php',
    success:function(data)
    {
      if(data==1)
      { 
        alert('Not updated');
      
      }
      else
      {
        alert("Update Successfully");
		lead()
      }
      
    }       
    });
    }
    </script>
