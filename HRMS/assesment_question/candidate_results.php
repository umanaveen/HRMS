<?php
require '../../connect.php';
?>
<div class="content-wrapper" style="padding-left: 50px;">
<!-- Content Header (Page header) -->
<section class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h1>Assessment Results</h1>
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
<tr>
<th class="center">SNO</th>
<th>NAME</th>

<th>DATE</th>
<th>CONTACT NUMBER</th>
<th> Total Qns  </th>
<th> Total MARKS   </th>
<th> Status</th>
<th> Accept</th>
<th> Reject</th>
</tr>
</thead>
<tbody>

<?php 
$sql=$con->query("select distinct emp_id from employee_assessment_result ");
$cnt=1;
while($row_user = $sql->fetch(PDO::FETCH_ASSOC))
{
$eid=$row_user['emp_id'];

$que=$con->query("select * from emp_assessment_login_detail where staff_id='$eid'");
$row_qn = $que->fetch(PDO::FETCH_ASSOC);

$qn_name=$row_qn['qn_name_id'];
$sec=$con->query("select * from assessment_qn_master where qn_name='$qn_name'");
$row_sec = $sec->fetch(PDO::FETCH_ASSOC);
$section=$row_sec['section'];

$res=$con->query("select * from employee_assessment_result where emp_id='$eid' and qn_name_id='$qn_name'");
//echo "select * from employee_assessment_result where emp_id='$eid' and qn_name_id='$qn_name'";
$i=1;
while($row = $res->fetch(PDO::FETCH_ASSOC))
{
$qn=$row['question'];
$ans=$row['answer'];



$qn_mas=$con->query("select * from assessment_qn_master where id='$qn' and answer_key='$ans' ");
//echo "select * from assessment_qn_master where id='$qn' and  answer_key='$ans' and section='$section'";
$row_answers = $qn_mas->fetch(PDO::FETCH_ASSOC);

$correct_answer=$row_answers['answer_key'];

$row_count =$qn_mas->rowCount();

$qn_count=$i++;
if($row_count !=0)
{
 $cou[]=$row_count;
}
}
$count=count($qn);
?>
<tr>
<td class="center"><?php echo $cnt;?>.</td>
<td><?php echo $row_qn['first_name'].'.'.$row_qn['last_name'];?></td>
<td><?php echo $row_qn['created_on'];?></td>
<td><?php echo $row_qn['phone'];?></td>
<td><?php echo $qn_count;?></td>
<td><?php echo count($cou);?></td>
</tr>

<?php
$cnt=$cnt+1;
}
?>
</tbody>
</table>

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
function updatestatus1(sta,id) {


$.ajax({
// alert(sta);
type:"GET",
url: "HRMS/Question_Management/status.php",
data:'sta='+sta+'&id='+id,
//data:{sta: sta,id:id}

success: function(data){
{
if(data==1)
{ 
alert('Update Successfully');
candicate_results()
}
else
{
alert("not updated");
}

}
}
});



}
</script>	
<script>
function updatestatus(sta,id) {
//alert(sta);
//alert(id);

$.ajax({
// alert(sta);
type:"GET",
url: "HRMS/Question_Management/statusss.php",
data:'sta='+sta+'&id='+id,
//data:{sta: sta,id:id}

success: function(data){
{
if(data==1)
{ 
alert('Update Successfully');
candicate_results()
}
else
{
alert("not updated");
}

}
}
});



}
</script>