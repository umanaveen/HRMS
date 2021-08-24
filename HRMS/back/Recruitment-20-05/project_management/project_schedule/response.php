<?php
require '../../connect.php';



?>
 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
          <tr>
			<th><INPUT type="checkbox" name="select-all" id="select-all" onclick="toggle(this);"></th>
		  <th>Project Name</th>
		  <th>Employees</th>
		  <th>Action</th>
		  </tr>
      </thead>
      <tbody>
      <?php
	 // $department = $_REQUEST["department"];
//$division = $_REQUEST["division"];
//$status = $_REQUEST["status"];
      //$emp_sql=$con->query("SELECT * FROM `staff_master` INNER JOIN z_department_master ON staff_master.dep_id=z_department_master.id WHERE dep_id='$department' AND div_id='$division' AND staff_master.status='$status'
//");
$emp_sql=$con->query("SELECT project_name,employees FROM `project_schedule`  WHERE id='$project_name' AND id='$employees'");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;
      ?>
      <tr>
			<td><INPUT type="checkbox" name="chk[]"></td>
		  <td><?php echo $emp_res['project_name']; ?></td>
		  <td><?php echo $emp_res['employees']; ?></td>		  
		     </tr>

          <?php
           $i++;
          } 
          ?>
          </tbody>
        </table> 
	<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">
	
		
		
		
		