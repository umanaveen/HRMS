<?php
require '../../connect.php';
?>

<div class="content-wrapper" id="main_content">
<div class="container-fluid"->
  <!-- Breadcrumbs-->
  <!--ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Payroll Scale Master <?php if($con) {	echo "connect"; } ?></li>
  </ol-->
  <!-- Example DataTables Card-->
  <!--div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-table"></i>Payroll Scale Master
	  <input type="button" style="float:right;" class="btn btn-warning" name="new" value="ADD" onclick="scale_new()">
	  </div-->
    <div class="card-body"-->
      <div class="table-responsive">
       <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
          <tr>
          <!--th>#</th-->
          <th>Id</th>
          <th>Name</th>
		  <th>Status</th>
		  <th>Action</th>
          
        
          </tr>
          </thead>
         
          <tbody>
          <?php

          $sql=$con->query("SELECT id,name,status FROM payroll_scale_master where status=1");

          $i=1;
          while($res = $sql->fetch(PDO::FETCH_ASSOC))
          {
          ?>
          <tr>
          <!--td><?php echo $i; ?></td-->
	     <td><?php echo $res['id'] ; ?></td>
          <td><?php echo $res['name'] ; ?></td>
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
          <!--button class="btn btn-primary"  value="<?php echo $res['id']; ?>" onclick="scale_view(this.value)"> View</button-->
		  <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $res['id']; ?>" onclick="scale_edit(<?php echo $res['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
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