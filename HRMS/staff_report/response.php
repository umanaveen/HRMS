<?php
require '../../connect.php';



?>
 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
          <tr>
		  <th>Id</th>
		  <th>Code</th>
		  <th>Staff Name</th>
		  <th>Department</th>
		  <th>Status</th>
		  
		  
		</tr>
      </thead>
      <tbody>
      <?php
	  $department = $_REQUEST["department"];
$division = $_REQUEST["division"];
$status = $_REQUEST["status"];
      $emp_sql=$con->query("SELECT * FROM `staff_master` INNER JOIN z_department_master ON staff_master.dep_id=z_department_master.id WHERE dep_id='$department' AND div_id='$division' AND staff_master.status='$status'
");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;
      ?>
      <tr>
	  <td><?php echo $i; ?></td>
		  <td><?php echo $emp_res['emp_code']; ?></td>
		  <td><?php echo $emp_res['emp_name']; ?></td>
		 
		  <td><?php echo $emp_res['dept_name']; ?></td>
		  
		     <td>
		  <?php 
		  if($emp_res['status'] == 1)
		  {
			  ?>
		<span style="color:orange;text-align:center;"><b>Active</b></span>
		  <?php
		  } else if($emp_res['status'] == 0){
		  ?>
		  <span style="color:green;text-align:center;"><b>In Active</b></span>
		  <?php
		  }  
		  ?>
		   
		  </td>
          </tr>

          <?php
           $i++;
          } 
          ?>
          </tbody>
        </table> 
		
		
		
		
		