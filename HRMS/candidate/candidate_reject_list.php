<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
?>

	<div id="table_view">
<div  class="card card-primary">
              <div class="card-header">
            <h4>candidates Rejected List</h4>
			
          </div>
        
    <!-- Main content -->
    

<table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
	   <thead>
		<tr>
		  <th>Id</th>
		  <!--th>Company Name</th-->
		  <th>Name</th>
		  <th>Department</th>
		  <th>Position</th>
		  <th>Phone</th>
		  <th>Mail</th>
		  <th>Status</th>	  
		  <th>Action</th>
		</tr>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT *,c.id as cid,c.status as status FROM `candidate_form_details` c left join company_master cm on c.company_name=cm.id join designation_master d on c.position=d.id join z_department_master z on c.department=z.id where  c.status=32 order by c.id desc");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;
      ?>
      <tr>
	  <td><?php echo $i; ?></td>
		  <!--td><!?php echo $emp_res['companyname']; ?></td-->
		  <td><?php echo $emp_res['first_name']." ".$emp_res['last_name']; ?></td>
		 
		  <td><?php echo $emp_res['dept_name']; ?></td>
		  <td><?php echo $emp_res['designation_name']; ?></td>
		  <td><?php echo $emp_res['phone']; ?></td>
		  <td><?php echo $emp_res['mail']; ?></td>
		  <td>
<?php
if(($emp_res['status']==32))  
{
echo '<span style="color:blue;text-align:center;"><b>Rejected</b></span>';

}

?>
</td>
		     <!--td>
		  <!?php 
		  if($emp_res['status'] == 1)
		  {
			  ?>
		<span style="color:orange;text-align:center;"><b>Active</b></span>
		  <!?php
		  } else if($emp_res['status'] == 0){
		  ?>
		  <span style="color:green;text-align:center;"><b>In Active</b></span>
		  <!?php
		  }  
		  ?>
		   
		  </td-->
		  <?php
		  if( $emp_res['status'] == 32 )
		   {
			 ?> 
			 <td><button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="candidate_reject_view(<?php echo $emp_res['cid']; ?>)"> View</button>
			</td>
		<?php	  
		  }
		  ?>
		 
      </tr>
      <?php
	  $i++;
      }
      ?>
      </tbody>
      </table>
	  
	  </div>
	  <script>
	$(document).ready(function() {
		$('.dataTables-example').DataTable({
				responsive: true
		});
	});
  </script>
	  <script>
	  
	  function candidate_reject_view(v)
	  {
	$.ajax({
	type:"POST",
	url:"HRMS/candidate/candidate_reject_view.php?id="+v,
	success:function(data)
	{
		$("#table_view").html(data);
	}
	})

	  }
	  
	 
	  </script>