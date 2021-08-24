<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
?>
<div class="content-wrapper" style="padding-left: 50px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Scale Details</h1>
          </div>
          <div class="col-sm-6">
		
		  <a onclick=" scale_new()" style="float: right;" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> ADD</a>
	
		
		
          </div>
        </div>
      </div><!-- /.container-fluid -->
	</section>
    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
    <div class="row">
    <div class="col-md-12">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
    <div class="card-body box-profile">
		 
    <table id="example1" class="table table-bordered">
    <thead>
      <th>ID</th>
      <th>Scale Name</th>
	  <th>Date</th>
	  <th>Basic Pay</th>
	  <th>Special Pay</th>
      <th>Grade Pay</th>
	  <th>Da</th>
	  <th>Hra</th>
	  <th>Cca</th>
	  <th>Bonus</th>
	  <th>Additional Allowance</th>
	  <th>Others</th>
      <th>Status</th>
      <th>Action</th>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT * FROM master_scale_master ");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $emp_res['id']; ?></td>
      <td><?php echo $emp_res['scale_name']; ?></td>
	   <td><?php echo $emp_res['from_date']; ?></td>
	    <td><?php echo $emp_res['basic_pay']; ?></td>
		 <td><?php echo $emp_res['spl_pay']; ?></td>
		  <td><?php echo $emp_res['grade_pay']; ?></td>
		   <td><?php echo $emp_res['da']; ?></td>
		    <td><?php echo $emp_res['hra']; ?></td>
			 <td><?php echo $emp_res['cca']; ?></td>
			  <td><?php echo $emp_res['bonus']; ?></td>
			   <td><?php echo $emp_res['addition_allowance']; ?></td>
			    <td><?php echo $emp_res['others']; ?></td>
	  <td>
	  <?php
	  if($emp_res['status']==1)
	  {
		  echo "Active"; 
	  }
	  else
	  {
		  echo "Inactive";
	  }
	  ?>
	  </td>
      <td>
	  <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['id']; ?>" id="<?php echo $emp_res['id']; ?>" onclick="scale_edit(this.id)"><i class="fa fa-edit"></i> Edit</button>
	  </td>
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
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>





<script>
function scale_edit(ids)
{
	$.ajax({
    type:"GET",
    data:"ids="+ids,
    url:"/Recruitment/Recruitment/payroll/scale_details_edit.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function scale_new()
{
	
	$.ajax({
    type:"POST",
    url:'/Recruitment/Recruitment/scale_master/new.php',
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
</script>
