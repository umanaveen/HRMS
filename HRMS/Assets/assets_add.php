<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
?>
  <div class="card card-info">
              <div class="card-header">
                
				              <center><h3 class="card-title"><b>New Asset</b></h3></center>
		<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
              </div>


<form method="POST" action="">
<table class="table table-bordered">
        <tr>
        <td><center><img src="/HRMS/HRMS/Recruitment/image/userlog/bluebase.png"  style="width:300px;height:150px;"></center></td>
        <td colspan="5"><center><h1><b>Bluebase Software services Pvt Ltd</b></h1></center></td>
        </tr>
     
	
        
       
        <tr>
       <td>Asset Number</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter your Asset Number" id="assets_no" name="assets_no"></td>
        </tr>
        <tr>
        <td>Asset Name</td>
        <td colspan="5"><select class="form-control" id="asset_name" name="asset_name" >
		<option value="">Choose Assets</option>
		<?php $stmt = $con->query("SELECT * FROM assets_master ");
		while ($row = $stmt->fetch()) {?>
		<option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
		<?php } ?>
		</select></td>
        </tr>
        
         <tr>
        <td>Brand Name</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Brand "  name="brand" id="brand"></td>
        </tr>
		<tr>
        <td>Vendor Name</td>
        <td colspan="5"><!--input type="text" class="form-control" placeholder="Vendor "  name="vendor" id="vendor"-->
		<select  class="form-control" placeholder="Vendor "  name="vendor" id="vendor">
		<?php 
		$ven=$con->query("select * from doller_vendor_mastor where status=1");
		while($venfet=$ven->fetch())		
		{
			?>
			<option value="<?php echo $venfet['id']; ?>"><?php echo $venfet['vendor_name']; ?></option>
			<?php 
		}
		?>
		</select>
		</td>
        </tr>
		
		<tr>
        <td>Purchase Date</td>
        <td colspan="5"><input type="date" class="form-control"  id="date" name="date" ></td>
        </tr>
		
		 <tr>
        <td>Serial Number</td>
        <td colspan="5">
			<input type="text"  id="serial" name="serial" class="form-control"  placeholder="Enter serial No">
		</td>
        </tr>
			<tr>
		<td>Configuraton:</td>
		<td colspan="5">
		<input type="text"  id="config" name="config" placeholder="Enter config" class="form-control"  >
		</td>
        </tr> 
		 <tr>
        <td>Warranty</td>
        <td colspan="5">
			<input type="text"  id="Warranty" name="Warranty" class="form-control"  placeholder="Enter Warranty ">
		</td>
        </tr>
		<tr>
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="insert_assets()" value="save"></td>
        </tr>
        </table>
</form>
</div>
<script>
		function back()
    {
  Asset()
  }
  </script>
  <script>
    function insert_assets()
    {
    var id=0;
    var data = $('form').serialize();
	//alert(data);
    $.ajax({
    type:'GET',
    data:"id="+id, data,
    url:'/HRMS/HRMS/Assets/assets_insert.php',
    success:function(data)
    {
      if(data!='')
      { 
        alert('Entry Successfully');
       Asset()
      }
      else
      {
        alert("No Data choose");
      }
      
    }       
    });
    }
	
	$(document).ready(function() {
$('#Department').on('change', function() {

var department_id = this.value;
//alert(department_id);
$.ajax({
url: "HRMS/CRM/find_emp.php",
type: "POST",
data: {
department_id: department_id
},
cache: false,
success: function(result){
$("#employee").html(result);

}
});
});
});
</script>
