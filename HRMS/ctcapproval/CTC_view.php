<?php
require '../../connect.php';
?>

<style>
#page-wrapper{
	margin-left: 117px !important;
}
</style>

<div class="content-wrapper" id="page-wrapper">

<div class="container-fluid"> 
                    <div class="row content">
                        <div class="col-lg-12">
                            <h1 class="page-header">CTC List</h1>
                        </div>
						</div>
						<div class="row content">
						 <div class="col-lg-12">
<a onclick="add_ctc()" style="float: right;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus"></i>ADD</a>

          </div>
		  
                        <!-- /.col-lg-12 -->
                    </div>
					
				
					<br>
					
					<div class="row content">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    CTC List
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
                                      
				
<thead>
<th>#</th>
<th>Name</th>
<th>Department</th>
<th>Position</th>
<th>Apptitude & Logical Results</th> 
<th>Actions</th>
</thead>
<tbody>
<?php
$emp_sql=$con->query("SELECT md.candidate_id,cfd.first_name,cfd.position,zdm.dept_name FROM `final_technical_team_details` md right join candidate_form_details cfd on md.candidate_id=cfd.id join z_department_master zdm on zdm.id=cfd.department where cfd.status=13");
//echo "SELECT md.candidate_id,cfd.first_name,cfd.position,zdm.dept_name FROM `final_technical_team_details` md right join candidate_form_details cfd on md.candidate_id=cfd.id join z_department_master zdm on zdm.id=cfd.department where cfd.status=17";

$i=1;
while($ctc_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
{
	$candidate_id=$ctc_res['candidate_id'];
	$answer=$con->query("SELECT count(cr.answer) as tot_marks FROM `candicate_results` cr join question_master qm on cr.question=qm.id where ueser_id='$candidate_id' and cr.answer=qm.answer_key");
	$total_mark=$answer->fetch(PDO::FETCH_ASSOC);
?>
<tr>
<td><?php echo $i++; ?></td>
<td><?php echo $ctc_res['first_name']; ?></td>
<td><?php echo $ctc_res['dept_name']; ?></td>
<td><?php echo $ctc_res['position']; ?></td>
<td><center><?php echo $total_mark['tot_marks']; ?></center></td>  
<td>
<button data-id="<?php echo $ctc_res['candidate_id']; ?>" onclick="ctc_edit(<?php echo $ctc_res['candidate_id']; ?>)"><i class="fa fa-edit"></i></button>
</td>
</tr>
<?php
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

<!-- /.content -->
</div>
</div>
</div>

<script>
            $(document).ready(function() {
                $('.dataTables-example').DataTable({
                        responsive: true
                });
            });
        </script>
<script>
function add_ctc()
{
	//alert("hii");
 $.ajax({
type:"POST",
url:"HRMS/ctcapproval/CTC_approval.php",
success:function(data){
$(".content").html(data);
}
}) 
}
function ctc_edit(v){
	$.ajax({
	type:"POST",
	url:"HRMS/ctcapproval/CTC_edit.php?id="+v,
	success:function(data)
	{
		$(".content").html(data);
		
	}
	})
}
</script>