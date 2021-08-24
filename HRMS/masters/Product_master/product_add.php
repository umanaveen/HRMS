<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];

?>
<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header">
<i class="fa fa-table"></i> Product  Add
<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-primary"></i>Back</a>
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
        <td colspan="6"><center><b>Add Products</b></center></td>
        </tr>
		
        
		
     
        <tr>
        <td>Product Name</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Product" id="product_name" name="product_name"></td>
        </tr>
      
		
       
		
		
		
		 
		
		
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="insert_product()" value="save"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>

			<script>
			 function insert_product()
    {
    var id=0;
	//alert(id);
    var data = $('form').serialize();
//alert(data);
    $.ajax({
    type:'POST',
    data:"id="+id, data,
  url:"HRMS/masters/Product_master/product_submit.php",
    success:function(data)
    {      
        alert("Entry Successfully");
		Product_master()
		          
    }       
    });
    }
	function back()
	
	{
		Product_master()

	}
	</script>