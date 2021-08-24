<?php
require '../../connect.php';
include("../../user.php");
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];
?>
<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5"> Asset List</font></h3>
			
			<a onclick="add_asset()"  style="float: right;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i> Add</a>
              </div>
             
  
              <div class="card-body">

       <table class="dataTables-example table table-striped table-bordered table-hover"  id="example1">
		 
   
    <thead>
	<th>S.NO</th>
     
	      
				        <th>Asset </th>
				        <th>Asset Type</th>
						 <th>Asset Number</th>
				        <th>Asset Name</th>
						<th>Brand Name</th>
						<th>Purchase Date</th>
						<th>Serial Number</th>
						<th>Configuration</th>
						<th>Warranty</th>
						<th>Status</th>
<!--th>Action</th-->
 
     
      <!--th>Tools</th-->
      </thead>
      <tbody>
      <?php
	  
      $assets_sql=$con->query("SELECT a.*,m.*,a.id as aid FROM `assets_form_detail` a INNER JOIN assets_master m ON a.asset_name = m.id");
	   $i=1;
      while($assets_res = $assets_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>
	
      <td><?php echo $assets_res['asset']; ?></td>
      <td><?php echo $assets_res['asset_type']; ?></td>
      <td><?php echo $assets_res['prefix_code']."-".$assets_res['asset_no']; ?></td>
      <td><?php echo $assets_res['name']; ?></td>
	       <td><?php echo $assets_res['brand_name']; ?></td>
		   <td><?php echo $assets_res['p_date']; ?></td>
		   <td><?php echo $assets_res['Serial_no']; ?></td>
		   <td><?php echo $assets_res['config']; ?></td>
		   <td><?php echo $assets_res['warranty']; ?></td>
			 <td>
<?php if(($assets_res['status']==1))  
{

echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
}
if(($assets_res['status']==2))  
{
echo '<span style="color:red;text-align:center;"><b>Pending</b></span>';

}

?></td>
<td><button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $assets_res['aid']; ?>" onclick="asset_edit(<?php echo $assets_res['aid']; ?>)"><i class="fa fa-edit"></i> Edit</button></td>
      </tr>
      <?php
	  $i++;
      }
      ?>
      </tbody>
      </table>
	 
      </div>
<!-- /.card -->
      </div>
      
<script>
            $(document).ready(function() {
                $('.dataTables-example').DataTable({
                        responsive: true
                });
            });
        </script>

<script>
   	function add_asset()
    {
		//alert("hii");
     $.ajax({
    type:"POST",
	url:"HRMS/Assets/assets_form.php",
    success:function(data){
    $("#main_content").html(data);
    }
    }) 
  }
  
  	function asset_edit(v)
    {
		//alert("hii");
     $.ajax({
    type:"POST",
	url:"HRMS/Assets/assets_form_edit.php?id="+v,
    success:function(data){
    $("#main_content").html(data);
    }
    }) 
  }
</script>