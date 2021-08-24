<?php
require '../../connect.php';
?>

<div  class="card card-primary">
	<div class="card-header">
	<h3 class="card-title"><font size="5">Leave Master</font></h3>
	<a onclick="Leave_new()"  style="float: right;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i>  New Leave</a>
			
		</div>
		<!-- /.card-header -->
		<div class="card-body">
			  
		<table class="table table-striped table-bordered table-hover" id="dataTables-example">
		<thead>
		<tr>
		<th>#</th>
		<th>Date</th>
		<th>Leave</th>
		<th>Days per Month</th>
		<th>Days per Year</th>
		<th>Cumulative</th>
		<th>Status</th>
		<th>Actions</th>
		</tr>
		</thead>

		<tbody>
		<?php

		$sql=$con->query("SELECT id, from_date, leave_name, days_per_month, days_per_year, is_cummulative, status,case when status=1 then 'Active' else 'InActive' end as status FROM leave_master where  status=1");

		$i=1;
		while($res = $sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $res['from_date'] ; ?></td>
			<td><?php echo $res['leave_name'] ; ?></td>
			<td><?php echo $res['days_per_month'] ; ?></td>
			<td><?php echo $res['days_per_year'] ; ?></td>
			<td><?php echo $res['is_cummulative'] ; ?></td>
			<!--td><?php echo $res['status'] ; ?></td-->
			<td>
		   
			<?php 
			if($res['status'] ==0)
			{

				echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
			 
			}
			else
			{

				echo '<span style="color:red;text-align:center;"><b>INActive</b></span>';
			
			}
			?>
	 
	  
     </td>
          <td>
          <!--button class="btn btn-primary"  value="<?php echo $res['id']; ?>" onclick="Leave_view(this.value)"> View</button-->
          <button class="btn btn-danger" value="<?php echo $res['id']; ?>" onclick="Leave_edit(this.value)">Edit</button>
          </td>
          </tr>

          <?php
          $i++;
          }
          ?>
          </tbody>
        </table>
     	
              </div>
              <!-- /.card-body -->
            </div>

<script>
            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                        responsive: true
                });
            });
        </script>
<script>
function Leave_view(id)
{
	$.ajax({
    type:"GET",
    data:"ids="+id,
    url:"/HRMS/HRMS/Leave_master/view.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function Leave_edit(ids)
{
	$.ajax({
    type:"GET",
    data:"ids="+ids,
    url:"/HRMS/HRMS/Leave_master/edit.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function Leave_new()
{
	$.ajax({
    type:"POST",
    url:"/HRMS/HRMS/Leave_master/new.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
</script>