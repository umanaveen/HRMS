<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>
<!--div class="container-fluid"-->
<div class="card mb-3">

<form method="POST" action="HRMS/Recruitment/staff_asset_master/staff_asset_master_submit.php">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">
<tr>
<div class="row">
						 <!--div class="col-lg-12"-->
		  <a onclick=" back()" style="float: right;" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i>BACK</a>


          </div>
                        <!-- /.col-lg-12 -->
                    </div>
</tr>
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
<td>Asset</td>

<td colspan="2">
<select class="form-control" name="asset" id="asset">
<option value="ALL">ALL</option>
<option value="Office Stationery">Office Stationery</option>
<option value="Visiting Cards">Visiting Cards</option>
<option value="Keys">Keys</option>
<option value="Keys">Files</option>
<option value="Files">System</option>
<option value="Files">LapTop</option>
<option value="Files">ID Card</option>
<option value="Files">CUG</option>
<option value="Files">Access Card</option>
<option value="Files">ERP Access</option>
</select>
</td>
</tr>
</table>
<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">
</form>
<script>
		function back()
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/Recruitment/staff_asset_master/staff_asset_master.php",
    success:function(data){
    $(".content").html(data);
    }
    })
  }
  </script>
