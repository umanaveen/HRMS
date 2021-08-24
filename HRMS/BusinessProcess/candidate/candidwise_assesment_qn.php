<?php
require '../../connect.php';
require '../../user.php';
 $empid=$_SESSION['candidateid'];
?>
<div class="content-wrapper" style="padding-left: 50px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Assessment</h1>
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
	  <form method="POST" enctype="multipart/form-data">
    <table id="example1" class="table table-bordered">
   <thead>
<tr>


</tr>
</thead>
<tbody>

<?php   

$select=$con->query("SELECT * FROM candidate_round_details where candid_id='$empid' and status =1");
//echo "SELECT * FROM candidate_round_details where candid_id='$empid'";
$fdata = $select->fetch(PDO::FETCH_ASSOC);
echo $qn_name=$fdata['qn_id'];

$sql=$con->query("SELECT distinct section,name FROM question_master a join section_master s on a.section=s.id
where qn_name='$qn_name'");

$cnt=1;
while($row1 = $sql->fetch(PDO::FETCH_ASSOC))
//echo "<pre>";print_r($row);exit();
{
	$secid=$row1['section'];
	$sql1=$con->query("SELECT * FROM question_master a join section_master s on a.section=s.id
where section='$secid'");
//echo "SELECT * FROM question_master a join section_master s on a.section=s.id where section='$secid'";
?>
<tr><td><h4><b><?php echo $row1['name'];?></b></h4>	</td>
<?php

	while($row = $sql1->fetch(PDO::FETCH_ASSOC))
	{
	
		?>
	
<tr>
<td class="center"><?php echo $cnt;?>.</td>

<td style="font-size: 18px;">

<?php echo $row['Questions'];?>



<br>
<br>
 
 <input type="radio"  name="answer_value_<?php echo $cnt;?>" id="answer" value="1">
 <input type="hidden"  name="question_value_<?php echo $cnt;?>" id="question" value="<?php echo $cnt;?>">
 <?php echo $row['Option_A'];?>

<br>

<input type="radio"  name="answer_value_<?php echo $cnt;?>" id="answer" value="2">
<input type="hidden"  name="question_value_<?php echo $cnt;?>" id="question" value="<?php echo $cnt;?>">
<?php echo $row['Option_B'];?>

<br>

<input type="radio"  name="answer_value_<?php echo $cnt;?>" id="answer" value="3">
<input type="hidden"  name="question_value_<?php echo $cnt;?>" id="question" value="<?php echo $cnt;?>">
<?php echo $row['Option_C'];?>

<br>

<input type="radio"  name="answer_value_<?php echo $cnt;?>" id="answer" value="4">
<input type="hidden"  name="question_value_<?php echo $cnt;?>" id="question" value="<?php echo $cnt;?>">
<?php echo $row['Option_D'];?>
</td>



</tr>

<?php 

$cnt=$cnt+1;

 }

?>

 </tr>
 <?php
 
}
 $total=$cnt;
?>
<input type="hidden" name="count" id="count" value="<?php echo $total;?>"> 
 </tbody>
<input type="hidden" name="candidateid" value="<?php echo $empid;?>">
<input type="hidden" name="qn_id" value="<?php echo $qn_name;?>">
      </table>
	  <input type="button" class="btn btn-o btn-primary" name="submit" id="<?php echo $total;?>" onclick="Answer_keys(this.id)" value="Submit">
	  </form>
<!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
</div>
</div>
 <script>
    function Answer_keys(v)
    {
		
    var count=v;
	//alert(id);
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data:"count="+count, data,
    url:'HRMS/candidate/Answer_validation.php',
	
    success:function(data)
    {
		
     alert('Your  Answer  Updated Successfully');
         window.location='login/logout.php'
      
    }       
    });
    }
    </script>