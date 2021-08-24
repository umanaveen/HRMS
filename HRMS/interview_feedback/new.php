<?php
require '../../connect.php';
include("../../user.php");
echo $userrole=$_SESSION['userrole'];
$userid=$_SESSION['candidateid'];
?>
<div  class="card card-primary">
              <div class="card-header">
            <h3>Feedback Form list</h3>
			
		<?php if($userrole=='ROLE-004' && $userrole=='ROLE-005' && $userrole=='ROLE-008' && $userrole=='R005')	{?>
		  <a onclick="return add_employee()" style="float: right;" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> ADD</a>
	<?php	} ?>
          </div>
       
		
		
     
       
    <!-- Main content -->
  
	 <?php			//hr

	
	 if( $userrole=='R003') { ?>
			 
    <table id="example1" class="table table-bordered">
      <thead>
		  <th> ID</th>		  
		  <th>Name</th>
		  <th>Position</th>
		  
		  <th>Head status</th>
		  <th>Status</th>
		  <th>Tools</th>
      </thead>
      <tbody>
      <?php
      $candid=$userid;
	  $sel=$con->query("select * from staff_master where candid_id='$candid'");
	  //echo "select * from staff master where candid_id='$candid'";
	  $fet=$sel->fetch();
	  $sid=$fet['id'];
	  //$inter=$con->query("select * from candidate_round_details where person_id='$sid'and status=1");
	  //echo "slect * from candidate_rounds_details where person_id='$sid'and staus=1";
       $emp_sql=$con->query("SELECT *,d.designation_name as dname,c.status as status,c.id as id FROM candidate_form_details c join designation_master d on c.position=d.id where c.id in(select candid_id from candidate_round_details where person_id='$sid')"); 
/*  echo "SELECT *,d.designation_name as dname,c.status as status,c.id as id FROM candidate_form_details c join designation_master d on c.position=d.id where c.id in(select candid_id from candidate_round_details where person_id='$sid'and status=1 and status=2 or status=5 or status=6 or status=7)"; */
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;
	  
      ?>
      <tr>
		  <td><?php echo $i; ?></td>
		  
		  <td><?php echo $emp_res['first_name']." ".$emp_res['last_name']; ?></td>
		 
		  <td><?php echo $emp_res['dname']; ?></td>
		<?php 
		$csel=$con->query("select status from candidate_round_details where candid_id='$emp_id' and person_id='$sid'");
		//echo "select status from candidate_round_details where candid_id='$emp_id' and person_id='$sid'";
		$cfet=$csel->fetch();
		$cstatus=$cfet['status'];
		
		?>
			   <td>
		  <?php 
		   if($emp_res['status'] == 5)
		  {
		  ?>
		  <span style="color:green;text-align:center;"><b>Selected for Second Level</b></span>
		  <?php
		  }  else if($emp_res['status'] == 7){
		  ?>
		    <span style="color:Red;text-align:center;"><b>Rejected</b></span>
			<?php
		  }
		  else if($emp_res['status'] == ''){
		  ?>
		   <span style="color:green;text-align:center;"><b>APPROVED BY MD</b></span>
		 
		  <?php
		  } else if($emp_res['status'] == 8){
		  ?>
		   <span style="color:green;text-align:center;"><b>NOT APPROVED BY MD</b></span>
		   <?php
		  }else if($emp_res['status'] == 9){
		  ?>
		   <span style="color:green;text-align:center;"><b>REJECTED BY MD</b></span>
		   <?php
		  }
		  else if($emp_res['status'] == 13){
		  ?>
		   <span style="color:green;text-align:center;"><b>Selected for third Level</b></span>
		   <?php
		  }
		   else if($emp_res['status'] == 10){
		  ?>
		   <span style="color:green;text-align:center;"><b> CTC Approved</b></span>
		   <?php
		  }
		  else if($emp_res['status'] == 14){
		  ?>
		   <span style="color:green;text-align:center;"><b>Technical team 2 Waiting List</b></span>
		   <?php
		  }
		  else if($emp_res['status'] == 15){
		  ?>
		   <span style="color:green;text-align:center;"><b>REJECTED BY Technical 2 </b></span>
		   <?php
		  }
		  ?>
		  </td>
		   <td>
		  <?php 
		  if($cstatus == 3)
		  {
			  ?>
		<span style="color:orange;text-align:center;"><b>PENDING</b></span>
		  <?php
		  } else if($cstatus == 5)
		  {
		  ?>
		  <span style="color:green;text-align:center;"><b>Selected for Second Level</b></span>
		  <?php
		  }  else if($cstatus == 6){
		  ?>
		   <span style="color:blue;text-align:center;"><b>Waiting List</b></span>
		  <?php
		  } else if($cstatus == 7){
		  ?>
		    <span style="color:Red;text-align:center;"><b>Rejected</b></span>
			<?php
		  }
		  else if($cstatus == ''){
		  ?>
		   <span style="color:green;text-align:center;"><b>APPROVED BY MD</b></span>
		 
		  <?php
		  } else if($cstatus == 8){
		  ?>
		   <span style="color:green;text-align:center;"><b>NOT APPROVED BY MD</b></span>
		   <?php
		  }else if($cstatus == 9){
		  ?>
		   <span style="color:green;text-align:center;"><b>REJECTED BY MD</b></span>
		   <?php
		  }
		  else if($cstatus == 13){
		  ?>
		   <span style="color:green;text-align:center;"><b>Selected for third Level</b></span>
		   <?php
		  }
		   else if($cstatus == 10){
		  ?>
		   <span style="color:green;text-align:center;"><b> CTC Approved</b></span>
		   <?php
		  }
		  else if($cstatus == 14){
		  ?>
		   <span style="color:green;text-align:center;"><b>Technical team 2 Waiting List</b></span>
		   <?php
		  }
		  else if($cstatus == 15){
		  ?>
		   <span style="color:green;text-align:center;"><b>REJECTED BY Technical 2 </b></span>
		   <?php
		  }
		   else if($cstatus == 35){
		  ?>
		   <span style="color:green;text-align:center;"><b>Selected for next level </b></span>
		   <?php
		  }
		  ?>
		  </td>
		
		
		  <td><?php if($cstatus == 3){
			  ?>
		  <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="hr_insert(<?php echo $emp_res['id']; ?>)"> <i class="fa fa-plus"></i></button>
		 <?php }  ?>
		 <?php  if($cstatus == 6){?>
		   <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['id']; ?>" onclick="technical_edit(<?php echo $emp_res['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
	<?php } ?>
	   <?php  if($cstatus == 4|| $cstatus ==5 || $cstatus ==13 || $cstatus ==14 || $cstatus ==15 || $cstatus == 7|| $cstatus ==9 || $cstatus ==10 || $cstatus ==35 ){?> <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="hr_view(<?php echo $emp_res['id']; ?>)"> View</button>
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
	  <?php 
				}
				else if($userrole=='ROLE-004')
				{?>
	<table id="example1" class="table table-bordered">
	   <thead>
		<tr>
		  <th>Id</th>
		  <th>Candidate Name</th>
		  <th>Position</th>
		  
		  <th>Head Status</th>
		  <th>Status</th>
		 
		   <th>Action</th>
		</tr>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT * FROM candidate_form_details where status=0 or status=4 or status=5 or status=6 or status=7 or status=10 or status=13 or status=14 or status=15");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;
      ?>
      <tr>
		  <td><?php echo $i; ?></td>
		  
		  <td><?php echo $emp_res['first_name']; ?></td>
		 
		  <td><?php echo $emp_res['position']; ?></td>
		
		  <td>
		  
			  <?php
		 echo '<span style="color:brown;text-align:center;"><b>RECRUITER  LEVEL  CROSSED</b></span>';
		  ?>
		 
		  </td>
		   <td>
		  <?php 
		  if($emp_res['status'] == 0)
		  {
			  ?>
		<span style="color:orange;text-align:center;"><b>PENDING</b></span>
		  <?php
		  } else if($emp_res['status'] == 4){
		  ?>
		  <span style="color:green;text-align:center;"><b>Selected for Second Level</b></span>
		  <?php
		  }  else if($emp_res['status'] == 5){
		  ?>
		   <span style="color:blue;text-align:center;"><b>Waiting List</b></span>
		  <?php
		  } else if($emp_res['status'] == 6){
		  ?>
		    <span style="color:Red;text-align:center;"><b>Rejected</b></span>
			<?php
		  }
		  else if($emp_res['status'] == 7){
		  ?>
		   <span style="color:green;text-align:center;"><b>APPROVED BY MD</b></span>
		 
		  <?php
		  } else if($emp_res['status'] == 8){
		  ?>
		   <span style="color:green;text-align:center;"><b>NOT APPROVED BY MD</b></span>
		   <?php
		  }else if($emp_res['status'] == 9){
		  ?>
		   <span style="color:green;text-align:center;"><b>REJECTED BY MD</b></span>
		   <?php
		  }
		  else if($emp_res['status'] == 13){
		  ?>
		   <span style="color:green;text-align:center;"><b>Selected for third Level</b></span>
		   <?php
		  }
		   else if($emp_res['status'] == 10){
		  ?>
		   <span style="color:green;text-align:center;"><b> CTC Approved</b></span>
		   <?php
		  }
		  else if($emp_res['status'] == 14){
		  ?>
		   <span style="color:green;text-align:center;"><b>Technical team 2 Waiting List</b></span>
		   <?php
		  }
		  else if($emp_res['status'] == 15){
		  ?>
		   <span style="color:green;text-align:center;"><b>REJECTED BY Technical 2 </b></span>
		   <?php
		  }
		  ?>
		  </td>
		
		  <td><?php if($emp_res['status'] == 0){
			  ?>
		  <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="feedback_insert(<?php echo $emp_res['id']; ?>)"> <i class="fa fa-plus"></i></button>
		 <?php }  ?>
		 <?php  if($emp_res['status'] == 5){?>
		   <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['id']; ?>" onclick="technical_edit(<?php echo $emp_res['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
	<?php } ?>
	   <?php  if($emp_res['status'] == 4|| $emp_res['status'] ==6 || $emp_res['status'] ==13 || $emp_res['status'] ==14 || $emp_res['status'] ==15 || $emp_res['status'] == 7|| $emp_res['status'] ==9 || $emp_res['status'] ==10 ){?> <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="technical_view(<?php echo $emp_res['id']; ?>)"> View</button>
	 <?php }
	 ?>
		 </td>
      </tr>
      <?php
	  $i++;
      }
      ?>
      </tbody>
      </table>
				<?php } 
				else if($userrole=='R001') //MD
				{?>
	<table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
	   <thead>
		<tr>
		  <th>Id</th>
		  <th>Candidate Name</th>
		  <th>Position</th>
		  
		  <th>Head Status</th>
		  <th>Status</th>
		   <th>Action</th>
		</tr>
      </thead>
      <tbody>
      <?php
       $candid=$userid;
	  $sel=$con->query("select * from staff_master where candid_id='$candid'");
	  //echo "select * from staff master where candid_id='$candid'";
	  $fet=$sel->fetch();
	  $sid=$fet['id'];
	  //$inter=$con->query("select * from candidate_round_details where person_id='$sid'and status=1");
	  //echo "slect * from candidate_rounds_details where person_id='$sid'and staus=1";
       $emp_sql=$con->query("SELECT *,d.designation_name as dname,c.status as status,c.id as id FROM candidate_form_details c left join designation_master d on c.position=d.id where c.id in(select candid_id from candidate_round_details where person_id='$sid')"); 
	   $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;
      ?>
      <tr>
	  <td><?php echo $i; ?></td>
		  <td><?php echo $emp_res['first_name']." ". $emp_res['last_name']; ?></td>
		 
		  <td><?php echo $emp_res['position']; ?></td>
		  <?php 
		$csel=$con->query("select status from candidate_round_details where candid_id='$emp_id' and person_id='$sid'");
		//echo "select status from candidate_round_details where candid_id='$emp_id' and person_id='$sid'";
		$cfet=$csel->fetch();
		 $cstatus=$cfet['status'];
		
		?>
		   <td>
		  <?php 
		  if($emp_res['status'] == 0)
		  {
			  ?>
		<span style="color:orange;text-align:center;"><b>PENDING</b></span>
		  <?php
		  } else if($emp_res['status'] == 4){
		  ?>
		  <span style="color:green;text-align:center;"><b>Selected for second Level</b></span>
		  <?php
		  }  else if($emp_res['status'] == 6){
		  ?>
		   <span style="color:blue;text-align:center;"><b>Waiting List</b></span>
		  <?php
		  } else if($emp_res['status'] == 5){
		  ?>
		    <span style="color:Red;text-align:center;"><b>Rejected</b></span>
			<?php
		  }else if($emp_res['status'] == 7){
		  ?>
		   <span style="color:green;text-align:center;"><b>APPROVED BY MD</b></span>
		 
		  <?php
		  } else if($emp_res['status'] == 8){
		  ?>
		   <span style="color:green;text-align:center;"><b>NOT APPROVED BY MD</b></span>
		   <?php
		  }else if($emp_res['status'] == 9){
		  ?>
		   <span style="color:green;text-align:center;"><b>REJECTED BY MD</b></span>
		   <?php
		  }
		  else if($emp_res['status'] == 13){
		  ?>
		   <span style="color:green;text-align:center;"><b>Waiting for CTC approval</b></span>
		   <?php
		  }
		  else if($emp_res['status'] == 10){
		  ?>
		   <span style="color:green;text-align:center;"><b> CTC Approved</b></span>
		   <?php
		  }
		  else if($emp_res['status'] == 14){
		  ?>
		   <span style="color:green;text-align:center;"><b>Technical team 2 Waiting List</b></span>
		   <?php
		  }
		  else if($emp_res['status'] == 15){
		  ?>
		   <span style="color:green;text-align:center;"><b>REJECTED BY Technical 2 </b></span>
		   <?php
		  }
		  ?>
		   </td>
		   
		   
		     <td>
		  <?php 
		  if($cstatus == 3)
		  {
			  ?>
		<span style="color:orange;text-align:center;"><b>PENDING</b></span>
		  <?php
		  } else if($cstatus == 4){
		  ?>
		  <span style="color:green;text-align:center;"><b>Selected for second Level</b></span>
		  <?php
		  }  else if($cstatus == 6){
		  ?>
		   <span style="color:blue;text-align:center;"><b>Waiting List</b></span>
		  <?php
		  } else if($cstatus == 5){
		  ?>
		    <span style="color:Red;text-align:center;"><b>Rejected</b></span>
			<?php
		  }else if($cstatus == 7){
		  ?>
		   <span style="color:green;text-align:center;"><b>APPROVED BY MD</b></span>
		 
		  <?php
		  } else if($cstatus == 8){
		  ?>
		   <span style="color:green;text-align:center;"><b>NOT APPROVED BY MD</b></span>
		   <?php
		  }else if($cstatus == 9){
		  ?>
		   <span style="color:green;text-align:center;"><b>REJECTED BY MD</b></span>
		   <?php
		  }
		  else if($cstatus == 13){
		  ?>
		   <span style="color:green;text-align:center;"><b>Waiting for CTC approval</b></span>
		   <?php
		  }
		  else if($cstatus == 10){
		  ?>
		   <span style="color:green;text-align:center;"><b> CTC Approved</b></span>
		   <?php
		  }
		  else if($cstatus == 14){
		  ?>
		   <span style="color:green;text-align:center;"><b>Technical team 2 Waiting List</b></span>
		   <?php
		  }
		  else if($cstatus == 15){
		  ?>
		   <span style="color:green;text-align:center;"><b>REJECTED BY Technical 2 </b></span>
		   <?php
		  }
		  else if($cstatus == 16){
		  ?>
		   <span style="color:green;text-align:center;"><b>Approved by MD</b></span>
		   <?php
		  }
		  else if($cstatus == 18){
		  ?>
		   <span style="color:green;text-align:center;"><b>REJECTED BY MD</b></span>
		   <?php
		  }
		  ?>
		   </td>
		   <td><?php if( $cstatus =='3'){
			  ?>
		  <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="md_insert(<?php echo $emp_res['id']; ?>)"> <i class="fa fa-plus"></i><?php }  ?></button>
		  <?php  if($cstatus == 17 || $cstatus ==14){?>
		  
		   <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['id']; ?>" onclick="md_edit(<?php echo $emp_res['id']; ?>)"><i class="fa fa-edit"></i> Edit<?php } ?></button>
		   
		   <?php  if($cstatus == 18|| $cstatus ==16 ){?>  <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="md_view(<?php echo $emp_res['id']; ?>)"> View</button>
	 <?php } ?>
		 </td>
      </tr>
      <?php
      	$i++;
	  }
      ?>
      </tbody>
      </table>
				<?php 
				}

else if($userrole=='R002')//HOD
				{?>
	<table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
	   <thead>
		<tr>
		  <th>Id</th>
		  <th>Candidate Name</th>
		  <th>Position</th>
		  
		  <th>Head Status</th>
		  <th>Status</th>
		 
		   <th>Action</th>
		</tr>
      </thead>
      <tbody>
      <?php
      $candid=$userid;
	  $sel=$con->query("select * from staff_master where candid_id='$candid'");
	  //echo "select * from staff master where candid_id='$candid'";
	  $fet=$sel->fetch();
	  $sid=$fet['id'];
	  //$inter=$con->query("select * from candidate_round_details where person_id='$sid'and status=1");
	  //echo "slect * from candidate_rounds_details where person_id='$sid'and staus=1";
       $emp_sql=$con->query("SELECT *,d.designation_name as dname,c.status as status,c.id as id FROM candidate_form_details c join designation_master d on c.position=d.id where c.id in(select candid_id from candidate_round_details where person_id='$sid')"); 
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;
      ?>
      <tr>
		  <td><?php echo $i; ?></td>
		  
		  <td><?php echo $emp_res['first_name']; ?></td>
		 
		  <td><?php echo $emp_res['position']; ?></td>
		<?php 
		$csel=$con->query("select status from candidate_round_details where candid_id='$emp_id' and person_id='$sid'");
		//echo "select status from candidate_round_details where candid_id='$emp_id' and person_id='$sid'";
		$cfet=$csel->fetch();
		$cstatus=$cfet['status'];
		
		?>
		  <td>
		  <?php 
		  if($emp_res['status'] == 4)
		  {
			  ?>
		<span style="color:orange;text-align:center;"><b>PENDING</b></span>
		  <?php
		  } else if($emp_res['status'] == 13){
		  ?>
		  <span style="color:green;text-align:center;"><b>Selected for final Level</b></span>
		  <?php
		  }  else if($emp_res['status'] == 14){
		  ?>
		   <span style="color:blue;text-align:center;"><b>Waiting List</b></span>
		  <?php
		  } else if($emp_res['status'] == 15){
		  ?>
		    <span style="color:Red;text-align:center;"><b>Rejected</b></span>
			<?php
		  }
		  ?>
		  </td>
		  
		  
		  
		  
		   <td>
		  <?php 
		  if($cstatus == 3)
		  {
			  ?>
		<span style="color:orange;text-align:center;"><b>PENDING</b></span>
		  <?php
		  } else if($cstatus == 13){
		  ?>
		  <span style="color:green;text-align:center;"><b>Selected for final Level</b></span>
		  <?php
		  }  else if($cstatus == 14){
		  ?>
		   <span style="color:blue;text-align:center;"><b>Waiting List</b></span>
		  <?php
		  } else if($cstatus == 15){
		  ?>
		    <span style="color:Red;text-align:center;"><b>Rejected</b></span>
			<?php
		  }
		  ?>
		  </td>
		
		  <td><?php if($cstatus == 3){
			  ?>
		  <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="technical1_insert(<?php echo $emp_res['id']; ?>)"> <i class="fa fa-plus"></i></button>
		 <?php }  ?>
		 <?php  if($cstatus == 14){?>
		   <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['id']; ?>" onclick="technical1_edit(<?php echo $emp_res['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
	<?php } ?>
	   <?php  if($cstatus == 13|| $cstatus ==15 || $cstatus == 7|| $cstatus ==9){?>  <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="technical1_view(<?php echo $emp_res['id']; ?>)"> View</button>
	 <?php } ?>
		 </td>
      </tr>
      <?php
      
	  $i++;
	  }
      ?>
      </tbody>
      </table>
				<?php 
				
				}
else if($userrole=='R016' )//Admin
				{?>
	<table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
	   <thead>
		<tr>
		  <th>Id</th>
		  <th>Candidate Name</th>
		  <th>Position</th>		  
		  <th>Head Status</th>
		  <th>Status</th>		  
		  <th>Action</th>
		</tr>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT * FROM candidate_form_details where  status=11 or  status=1 or status=3 or status=4 or status=5 or status=6 or status=13 or status=14 or status=15 or status=7 or status=8 or status=9 or status=10 or status=15 or status=16 or status=17 or status=18 or status=20");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;
      ?>
      <tr>
	  <td><?php echo $emp_res['id']; ?></td>
		  <td><?php echo $emp_res['first_name']." ". $emp_res['last_name']; ?></td>
		 
		  <td><?php echo $emp_res['position']; ?></td>
		  
		    <td>
				  <?php
				 echo '<span style="color:brown;text-align:center;"><b>MD LEVEL CLEARED</b></span>';
				  ?>		 
		  </td>
		     <td>
		  <?php 
		  if($emp_res['status'] == 7)
		  {
			  ?>
		<span style="color:orange;text-align:center;"><b>PENDING</b></span>
		  <?php
		  } else if($emp_res['status'] ==5){
		  ?>
		  <span style="color:green;text-align:center;"><b>Technical Level Selected</b></span>
		 <?php
		  } else if($emp_res['status'] ==6){
		  ?>
		  <span style="color:green;text-align:center;"><b>Technical Level Waiting List</b></span>
		 <?php
		  } else if($emp_res['status'] ==7){
		  ?>
		  <span style="color:green;text-align:center;"><b>Technical Level Rejected</b></span>
		  <?php
		  } else if($emp_res['status'] == 13){
		  ?>
		  <span style="color:green;text-align:center;"><b>Selected for Final Level</b></span>
		  <?php
		  }  else if($emp_res['status'] == 8){
		  ?>
		   <span style="color:blue;text-align:center;"><b>Waiting List</b></span>
		  <?php
		  } else if($emp_res['status'] == 9){
		  ?>
		    <span style="color:Red;text-align:center;"><b>Rejected</b></span>
			<?php
		  }
		  /* else if($emp_res['status'] == 16){
		  ?>
		    <span style="color:green;text-align:center;"><b>Mail Sent</b></span>
			<?php
		  }
		  else if($emp_res['status'] == 17){
		  ?>
		    <span style="color:green;text-align:center;"><b>Document Submited</b></span>
			<?php
		  }
		  else if($emp_res['status'] == 18){
		  ?>
		    <span style="color:green;text-align:center;"><b>Document Approved</b></span>
			<?php
		  } */
		 else if($emp_res['status'] == 16){
		  ?>
		    <span style="color:green;text-align:center;"><b>MD Leval Selected</b></span>
			<?php
		  }
		else if($emp_res['status'] == 17){
		  ?>
		    <span style="color:green;text-align:center;"><b>MD Leval Waiting List</b></span>
			<?php
		  }
		else if($emp_res['status'] == 18){
		  ?>
		    <span style="color:green;text-align:center;"><b>MD Leval Rejected</b></span>
			<?php
		  }
		/*   else if($emp_res['status'] == 19){
		  ?>
		    <span style="color:green;text-align:center;"><b>Freeze</b></span>
			<?php
		  } */
		  ?>
		  </td>
		  
		   <td><?php if($emp_res['status'] == '' || $emp_res['status'] == '')
		   {
			  ?>
		  <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="mail_Send(<?php echo $emp_res['id']; ?>)"> <i class="fa fa-mail">Mail Send</i><?php }  ?></button>
		  
		  <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="admin_view(<?php echo $emp_res['id']; ?>)"> View</button>
		   <?php  if($emp_res['status'] == 13 || $emp_res['status'] ==9|| $emp_res['status'] ==10){?>  
	 <?php }

	 ?>
	 

		 </td>
      </tr>
      <?php
      }
      ?>
      </tbody>
      </table>
				<?php } 
				
				else if($userrole=='R005' || $userrole=='R006')//PHP Technical head
				{?>
	<table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
	   <thead>
		<tr>
		  <th>Id</th>
		  <th>Candidate Name</th>
		  <th>Position</th>		  
		  <th>Head Status</th>
		  <th>Status</th>		 
		  <th>Action</th>
		</tr>
      </thead>
      <tbody>
      <?php
      $candid=$userid;
	  $sel=$con->query("select * from staff_master where candid_id='$candid'");
	  //echo "select * from staff master where candid_id='$candid'";
	  $fet=$sel->fetch();
	  echo "hii".$sid=$fet['id'];
	  //$inter=$con->query("select * from candidate_round_details where person_id='$sid'and status=1");
	  //echo "slect * from candidate_rounds_details where person_id='$sid'and staus=1";
       $emp_sql=$con->query("SELECT *,d.designation_name as dname,c.status as status,c.id as id FROM candidate_form_details c join designation_master d on c.position=d.id where c.id in(select candid_id from candidate_round_details where person_id='$sid')"); 
/*  echo "SELECT *,d.designation_name as dname,c.status as status,c.id as id FROM candidate_form_details c join designation_master d on c.position=d.id where c.id in(select candid_id from candidate_round_details where person_id='$sid'and status=1 and status=2 or status=5 or status=6 or status=7)"; */
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;
      ?>
      <tr>
		  <td><?php echo $i; ?></td>
		  
		  <td><?php echo $emp_res['first_name']." ".$emp_res['last_name']; ?></td>
		 
		  <td><?php echo $emp_res['dname']; ?></td>
		<?php 
		$csel=$con->query("select status from candidate_round_details where candid_id='$emp_id' and person_id='$sid'");
		//echo "select status from candidate_round_details where candid_id='$emp_id' and person_id='$sid'";
		$cfet=$csel->fetch();
		$cstatus=$cfet['status'];
		
		?>
			   <td>
		  <?php 
		   if($emp_res['status'] == 5)
		  {
		  ?>
		  <span style="color:green;text-align:center;"><b>Selected for Second Level</b></span>
		  <?php
		  }  else if($emp_res['status'] == 7){
		  ?>
		    <span style="color:Red;text-align:center;"><b>Rejected</b></span>
			<?php
		  }
		  else if($emp_res['status'] == ''){
		  ?>
		   <span style="color:green;text-align:center;"><b>APPROVED BY MD</b></span>
		 
		  <?php
		  } else if($emp_res['status'] == 8){
		  ?>
		   <span style="color:green;text-align:center;"><b>NOT APPROVED BY MD</b></span>
		   <?php
		  }else if($emp_res['status'] == 9){
		  ?>
		   <span style="color:green;text-align:center;"><b>REJECTED BY MD</b></span>
		   <?php
		  }
		  else if($emp_res['status'] == 13){
		  ?>
		   <span style="color:green;text-align:center;"><b>Selected for third Level</b></span>
		   <?php
		  }
		   else if($emp_res['status'] == 10){
		  ?>
		   <span style="color:green;text-align:center;"><b> CTC Approved</b></span>
		   <?php
		  }
		  else if($emp_res['status'] == 14){
		  ?>
		   <span style="color:green;text-align:center;"><b>Technical team 2 Waiting List</b></span>
		   <?php
		  }
		  else if($emp_res['status'] == 15){
		  ?>
		   <span style="color:green;text-align:center;"><b>REJECTED BY Technical 2 </b></span>
		   <?php
		  }
		  ?>
		  </td>
		   <td>
		  <?php 
		  if($cstatus == 3)
		  {
			  ?>
		<span style="color:orange;text-align:center;"><b>PENDING</b></span>
		  <?php
		  } else if($cstatus == 5)
		  {
		  ?>
		  <span style="color:green;text-align:center;"><b>Selected for Second Level</b></span>
		  <?php
		  }  else if($cstatus == 6){
		  ?>
		   <span style="color:blue;text-align:center;"><b>Waiting List</b></span>
		  <?php
		  } else if($cstatus == 7){
		  ?>
		    <span style="color:Red;text-align:center;"><b>Rejected</b></span>
			<?php
		  }
		  else if($cstatus == ''){
		  ?>
		   <span style="color:green;text-align:center;"><b>APPROVED BY MD</b></span>
		 
		  <?php
		  } else if($cstatus == 8){
		  ?>
		   <span style="color:green;text-align:center;"><b>NOT APPROVED BY MD</b></span>
		   <?php
		  }else if($cstatus == 9){
		  ?>
		   <span style="color:green;text-align:center;"><b>REJECTED BY MD</b></span>
		   <?php
		  }
		  else if($cstatus == 13){
		  ?>
		   <span style="color:green;text-align:center;"><b>Selected for third Level</b></span>
		   <?php
		  }
		   else if($cstatus == 10){
		  ?>
		   <span style="color:green;text-align:center;"><b> CTC Approved</b></span>
		   <?php
		  }
		  else if($cstatus == 14){
		  ?>
		   <span style="color:green;text-align:center;"><b>Technical team 2 Waiting List</b></span>
		   <?php
		  }
		  else if($cstatus == 15){
		  ?>
		   <span style="color:green;text-align:center;"><b>REJECTED BY Technical 2 </b></span>
		   <?php
		  }
		  ?>
		  </td>
		
		
		  <td><?php if($cstatus == 3){
			  ?>
		  <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="feedback_insert(<?php echo $emp_res['id']; ?>)"> <i class="fa fa-plus"></i></button>
		 <?php }  ?>
		 <?php  if($cstatus == 6){?>
		   <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['id']; ?>" onclick="technical_edit(<?php echo $emp_res['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
	<?php } ?>
	   <?php  if($cstatus == 4|| $cstatus ==5 || $cstatus ==13 || $cstatus ==14 || $cstatus ==15 || $cstatus == 7|| $cstatus ==9 || $cstatus ==10 ){?> <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="technical_view(<?php echo $emp_res['id']; ?>)"> View</button>
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
			<?php 
			} 
			?>
       

<!-- /.content -->
</div>
<script>
	$(document).ready(function() {
		$('.dataTables-example').DataTable({
				responsive: true
		});
	});
  </script>
<script>
		function add_employee()
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/interview_feedback/interview_feedback.php",
    success:function(data){
     $("#main_content").html(data);
    }
    })
  }
  
    function question_edit(v){
		//lert(v);
	$.ajax({
	type:"POST",
	url:"HRMS/interview_feedback/feedback_edit.php?id="+v,
	success:function(data)
	{
		  $("#main_content").html(data);
	}
	})
}
function technical_edit(v){
		//lert(v);
	$.ajax({
	type:"POST",
	url:"HRMS/interview_feedback/technical_edit.php?id="+v,
	success:function(data)
	{
		  $("#main_content").html(data);
	}
	})
}
 function technical1_edit(v){
		//lert(v);
	$.ajax({
	type:"POST",
	url:"HRMS/interview_feedback/final_technical_edit.php?id="+v,
	success:function(data)
	{
		  $("#main_content").html(data);
	}
	})
}
  function technical_view(v){
	$.ajax({
	type:"POST",
	url:"HRMS/interview_feedback/technical_view.php?id="+v,
	success:function(data)
	{
		  $("#main_content").html(data);
	}
	})
}
   function technical1_view(v){
	$.ajax({
	type:"POST",
	url:"HRMS/interview_feedback/final_technical_view.php?id="+v,
	success:function(data)
	{
		  $("#main_content").html(data);
	}
	})
}
    function question_view(v){
	$.ajax({
	type:"POST",
	url:"HRMS/interview_feedback/feedback_view.php?id="+v,
	success:function(data)
	{
		  $("#main_content").html(data);
	}
	})
}

    function feedback_insert(v){
		alert(v);
	$.ajax({
	type:"POST",
	url:"HRMS/interview_feedback/feedback_insert.php?id="+v,
	success:function(data)
	{
		  $("#main_content").html(data);
	}
	})
}

    function technical1_insert(v){
		//alert(v);
	$.ajax({
	type:"POST",
	url:"HRMS/interview_feedback/finaltechnical_insert.php?id="+v,
	success:function(data)
	{
		  $("#main_content").html(data);
	}
	})
}
  function md_insert(v){
	$.ajax({
	type:"POST",
	url:"HRMS/interview_feedback/md_insert.php?id="+v,
	success:function(data)
	{
		  $("#main_content").html(data);
	}
	})
}
  function recruiter_insert(v){
	$.ajax({
	type:"POST",
	url:"HRMS/interview_feedback/recruiter_insert.php?id="+v,
	success:function(data)
	{
		  $("#main_content").html(data);
	}
	})
}
  function md_view(v){
	$.ajax({
	type:"POST",
	url:"HRMS/interview_feedback/md_view.php?id="+v,
	success:function(data)
	{
		  $("#main_content").html(data);
	}
	})
}
function md_edit(v){
		
	$.ajax({
	type:"POST",
	url:"HRMS/interview_feedback/md_edit.php?id="+v,
	success:function(data)
	{
		  $("#main_content").html(data);
	}
	})
}
function admin_view(v)
{
	$.ajax({
	type:"POST",
	url:"HRMS/interview_feedback/admin_view.php?id="+v,
	success:function(data)
	{
		  $("#main_content").html(data);
	}
	})
}

function hr_insert(v){
		alert(v);
	$.ajax({
	type:"POST",
	url:"HRMS/interview_feedback/hr_insert.php?id="+v,
	success:function(data)
	{
		  $("#main_content").html(data);
	}
	})
}
 function hr_view(v){
	$.ajax({
	type:"POST",
	url:"HRMS/interview_feedback/hr_view.php?id="+v,
	success:function(data)
	{
		  $("#main_content").html(data);
	}
	})
}

function mail_Send(id)
{
	$.ajax({
	type:"POST",
	url:"HRMS/interview_feedback/mail_send.php?id="+id,
	success:function(data)
	{
		if(data==0)
		{
			alert("Mail Not sent to candidate");
		window.location.href="index.php";
		}
	else
	{
		alert("Mail has been sent to candidate");
		window.location.href="index.php";
		
	}
	}
	})
}
</script>