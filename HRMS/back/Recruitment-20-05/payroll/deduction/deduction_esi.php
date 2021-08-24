<?php
require '../../../connect.php';
?>

<div class="content-wrapper" id="main_content">
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <!--ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Payroll Structure <?php if($con) {	echo "connect"; } ?></li>
  </ol-->
  <!-- Example DataTables Card-->
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-table"></i>DEDUCTION 
	  <input type="button" style="float:right;" class="btn btn-warning" name="new" value="ADD" onclick="deduction_esi()">
	  </div>
    <div class="card-body">
      <div class="table-responsive">
       <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
       
          <!--th>#</th-->
          <th>Id</th>
		  <th>Name</th>
          <th>From Date</th>
		   <th>Amount</th>
          <th>Percentage</th>
		  <th>Minimum Amount</th>
		  <th>Maximum Amount</th>
		  <th>Status</th>
          <th>Action</th>
         
          </thead>
         
          <tbody>
          <?php

          $sql=$con->query("SELECT id,name,from_date,amount,percentage,min_amount,max_amount,status FROM payroll_deduction_master");

          $i=1;
          while($res = $sql->fetch(PDO::FETCH_ASSOC))
          {
          ?>
          <tr>
          <!--td><?php echo $i; ?></td-->
	     <td><?php echo $res['id'] ; ?></td>
		 <td><?php echo $res['name'] ; ?></td>
         <td><?php echo $res['from_date'] ; ?></td>
		  <td><?php echo $res['amount'] ; ?></td>
         <td><?php echo $res['percentage'] ; ?></td>
         <td><?php echo $res['min_amount'] ; ?></td>
         <td><?php echo $res['max_amount'] ; ?></td>
         <td>
		  
	  <?php 
	  if($res['status'] ==1)
	  {
		  
	  echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
	  ?>
	  <?php }else {
		  
		 echo '<span style="color:red;text-align:center;"><b>INActive</b></span>';
		 ?>
      <?php }?>
	 
	  
     </td>
	  <td>
          <!--button class="btn btn-primary"  value="<?php echo $payroll_structure['id']; ?>" onclick="scale_view(this.value)"> View</button-->
          <!--button class="btn btn-danger" value="<?php echo $payroll_structure['id']; ?>" onclick="scale_edit(this.value)">Edit</button-->
		  <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $res['id']; ?>" onclick="deduction_esi_edit(<?php echo $res['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
          </td>
          </tr>

          <?php
          $i++;
          }
          ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
<script>
function deduction_esi_edit(ids)
{
	$.ajax({
    type:"GET",
    data:"ids="+ids,
    url:"/Recruitment/Recruitment/payroll/deduction/deduction_esi_edit.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}

function deduction_esi()
{
	
	$.ajax({
    type:"POST",
    url:"/Recruitment/Recruitment/payroll/deduction/deduction_esi_add.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
</script>
