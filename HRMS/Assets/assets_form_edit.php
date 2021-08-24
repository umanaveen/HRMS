<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
$assetid=$_REQUEST['id'];
$sql=$con->query("SELECT a.*,m.*,a.id as aid FROM `assets_form_detail`a join assets_master m on a.asset_name=m.id where a.id='$assetid'");
$sfet=$sql->fetch();

?>
  <div class="card card-info">
              <div class="card-header">
                
				              <center><h3 class="card-title"><b>New Asset</b></h3></center>
		<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
              </div>


<form method="POST" action="/HRMS/HRMS/Assets/assets_form_update.php" enctype="multipart/form-data">
<table class="table table-bordered">
        <tr>
        <td><center><img src="/HRMS/HRMS/Recruitment/image/userlog/bluebase.png"  style="width:300px;height:150px;"></center></td>
        <td colspan="5"><center><h1><b>Bluebase Software services Pvt Ltd</b></h1></center></td>
        </tr>
     
		<tr>
		<input type="hidden" name="aid" id="aid" value="<?php echo $sfet['aid'];?>">
        <td>Asset </td>
        <td colspan="5">
		<input type="text"  class="form-control" id="asset" name="asset" value="<?php echo $sfet['asset'];?>" readonly> </td>  
		</tr>		
		 <tr >
		 <?php
		 if($sfet['asset'] !='')
		 {
		 ?>
        <td>Asset Type</td>
        <td colspan="5">
		<input type="text"  class="form-control" id="asset_type" name="asset_type" value="<?php echo $sfet['asset_type'];?>" readonly>
		
		</td>		
		 <?php
		 }
		 else
		 {
			 
		 }
		 ?>	
		</tr>	
		
		 <tr id="asset_nme">
        <td>Asset Name</td>
        <td colspan="5">
		<input type="text"  class="form-control" id="asset_name" name="asset_name" value="<?php echo $sfet['name'];?>" readonly>
		</td>
        </tr>
        <tr>
       <td>Prefix</td>
        <td colspan="5"><input type="text" class="form-control"  id="prefix" name="prefix"  value="<?php echo $sfet['prefix'];?>" readonly></td>
        </tr>
       <tr>
       <td>Asset Number</td>
        <td colspan="5"><input type="text" class="form-control" id="assets_no" name="assets_no"  value="<?php echo $sfet['prefix']."-".$sfet['asset_no'];?>" readonly></td>
        </tr>
       
        
         <tr>
        <td>Brand Name</td>
        <td colspan="5"><input type="text" class="form-control"  name="brand" id="brand"  value="<?php echo $sfet['brand_name'];?>" ></td>
        </tr>
		<tr>
        <td>Vendor Name</td>
        <td colspan="5"><!--input type="text" class="form-control" placeholder="Vendor "  name="vendor" id="vendor"-->
		<select  class="form-control" placeholder="Vendor "  name="vendor" id="vendor">
		<?php 
		$ven_id=$sfet['vendor_name'];
		$ven_sel=$con->query("select * from doller_vendor_mastor where status=1 and id ='$ven_id'");
		$vfet=$ven_sel->fetch();
		?>
		<option value="<?php echo $vfet['id'];?>"><?php echo $vfet['vendor_name'];?></option>
		<?php 
		
		$ven=$con->query("select * from doller_vendor_mastor where status=1 and id !='$ven_id'");
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
        <td colspan="5"><input type="date" class="form-control"  id="pdate" name="pdate" value="<?php echo $sfet['p_date']; ?>"></td>
        </tr>
		
		 <tr>
        <td>Serial Number</td>
        <td colspan="5">
			<input type="text"  id="serial" name="serial" class="form-control" value="<?php echo $sfet['Serial_no']; ?>" >
		</td>
        </tr>
			<tr>
		<td>Configuraton:</td>
		<td colspan="5">
		<input type="text"  id="config" name="config" placeholder="Enter config" class="form-control" value="<?php echo $sfet['config']; ?>"  >
		</td>
        </tr> 
		 <tr>
        <td>Warranty</td>
        <td colspan="5">
			<input type="date"  id="Warranty" name="Warranty" class="form-control"   value="<?php echo $sfet['warranty']; ?>" >
		</td>
        </tr>
		 <tr>
        <td>HSN Code</td>
        <td colspan="5">
			<input type="text"  id="hsn_code" name="hsn_code" class="form-control" value="<?php echo $sfet['hsn_code']; ?>"  >
		</td>
        </tr>
		 <tr>
        <td>Part Number</td>
        <td colspan="5">
			<input type="text"  id="part_no" name="part_no" class="form-control" value="<?php echo $sfet['part_no']; ?>" >
		</td>
        </tr>
		 <!--tr>
        <td>Stock in hand</td>
        <td colspan="5">
			<input type="text"  id="in_hand" name="in_hand" class="form-control"  placeholder="">
		</td>
        </tr>
		
		  <tr>
        <td>Stock new</td>
        <td colspan="5">
			<input type="text"  id="new" name="new" class="form-control"  placeholder="">
		</td>
        </tr-->
		<tr>
        <td>Asset Value</td>
        <td colspan="5">
			<input type="text"  id="asset_value" name="asset_value" class="form-control"  value="<?php echo $sfet['asset_value']; ?>" >
		</td>
        </tr>
		<tr>
        <td>Invoice Number</td>
        <td colspan="5">
			<input type="text"  id="invoice_no" name="invoice_no" class="form-control" value="<?php echo $sfet['invoice_no']; ?>" >
		</td>
        </tr>
		<tr>
        <td>Location</td>
        <td colspan="5">
			<input type="text"  id="location" name="location" class="form-control" value="<?php echo $sfet['location']; ?>">
		</td>
        </tr>
		 <tr>
        <td>Invoice </td>
        <td colspan="5">
			<input type="file" class="form-control" id="file3" name="file3[]" />
		</td>
        </tr>
		<tr>
        <td colspan="6"><input type="submit" class="btn btn-success" name="save"  value="Update"></td>
        </tr>
        </table>
</form>
</div>
<script>
		function back()
    {
  asset_form()
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

$(document).ready(function() {

$('#asset_nme').hide();
$('#assets_type').hide();
});

function sub_type(v)
{
	var value=v;
	alert(v);
	if(value=="Internal Asset")
	{
		$('#assets_type').show();
		$('#asset_nme').hide();		
		$('#inter_asset').show();
		//document.getElementById('assets_type').style.visibility = "visible";
		
//document.getElementById('asset_nme').style.visibility = "hidden";
	}
	else if(value !=="Internal Asset")
	{
		$('#assets_type').hide();
		$('#asset_nme').show();
		$('#inter_asset').hide();
		//document.getElementById('assets_type').style.visibility = "hidden";		
//document.getElementById('asset_nme').style.visibility = "visible";
	}
	
	/* else
	{
		document.getElementById('asset_nme').style.visibility = "visible";
document.getElementById('assets_type').style.visibility = "hidden";
	} */
}

function get_asset(v)
{
	$.ajax({
		
		type:"post",
		url:"/HRMS/HRMS/Assets/get_assets.php?type="+v,
		success:function(data)
		{
			$('#inter_asset').html(data);
		}
	})
}

function get_asset_no(v)
{
	var id=v;
	var asset=$('#asset').val();
	var asset_type=$('#asset_type').val();
	
	$.ajax({
		
		type:"post",
		url:"/HRMS/HRMS/Assets/asset_number.php?id="+v+"&asset="+asset+"&asset_type="+asset_type,
		success:function(data)
		{
			$('#assets_no').val(data);
		}
	})
	
}

</script>
