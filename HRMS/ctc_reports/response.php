<?php
require '../../connect.php';
?>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
          <tr>
          <th>#</th>
          <!--<th>Interview Date</th>-->
          <th>Name</th>
          <th>Department</th>
          <th>Position</th>
          <th>Mail</th>
          <th>Phone</th>
          <th>Address</th>
          <th>Status</th>
          </tr>
          </thead>
          <tbody>
          <?php
		   /* $year=date('Y');
           $sql=$con->query("SELECT id,year, name, start_time, end_time,case when status=1 then 'Active' else 'InActive' end as status FROM training_create WHERE status=1");
          $i=1; */
		  $sql=$con->query("SELECT  first_name, department, position,mail,phone,address,status FROM candidate_form_details WHERE status=1");
		     $i=1;
          while($res = $sql->fetch(PDO::FETCH_ASSOC))
          { 
          ?>
          <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $res['first_name']; ?></td>
          <td><?php echo $res['department'] ; ?></td>
          <!--<td><?php echo date('d-m-Y',strtotime($res['start_time'])); ?></td>
          <td><?php echo date('d-m-Y',strtotime($res['end_time'])); ?></td>-->
          <td><?php echo $res['position'] ; ?></td>
          <td><?php echo $res['mail'] ; ?></td>
          <td><?php echo $res['phone'] ; ?></td>
          <td><?php echo $res['address'] ; ?></td>
         
          </tr>

          <?php
           $i++;
          } 
          ?>
          </tbody>
        </table>
		
		
		
		
		<!--?php
require '../../connect.php';
?>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
          <tr>
          <th>#</th>
          <th>Interview Date</th>
          <th>Name</th>
          <th>Department</th>
          <th>Position</th>
          <th>Mail Id</th>
          <th>Phone</th>
          <th>Location</th>
          <th>Status</th>
          </tr>
          </thead>
          <tbody>
          <?php
		 /*  $year=date('Y');
          $sql=$con->query("SELECT id,year, name, start_time, end_time,case when status=1 then 'Active' else 'InActive' end as status FROM training_create WHERE status=1");
          $i=1;
          while($res = $sql->fetch(PDO::FETCH_ASSOC))
          { */
          ?>
          <tr>
          <td><?php //echo $i; ?></td>
          <td><?php //echo/// $res['year']; ?></td>
          <td><?php //echo //$res['name'] ; ?></td>
          <td><?php //echo// date('d-m-Y',strtotime($res['start_time'])); ?></td>
          <td><?php //echo //date('d-m-Y',strtotime($res['end_time'])); ?></td>
          <td><?php// echo //$res['status'] ; ?></td>
          <td><?php// echo //$res['status'] ; ?></td>
          <td><?php// echo //$res['status'] ; ?></td>
          <td><?php// echo //$res['status'] ; ?></td>
         
          </tr>

          <?php
         /*  $i++;
          } */
          ?>
          </tbody>
        </table-->