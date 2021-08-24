<?php
require '../../connect.php';
 $id=$_REQUEST['id'];

$stmt = $con->prepare("SELECT id,qn_name,section,Questions,Option_A,Option_B,Option_C,Option_D,answer_key,status FROM assessment_qn_master WHERE id='$id'"); 
$stmt->execute(); 
$row = $stmt->fetch();

?>
<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> QUESTIONS  EDIT
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus"></i>Back</a>
</div>
<div class="card-body" id="printableArea">
<form method="POST" action="" enctype="multipart/type">
<table class="table table-bordered">
<tr>
<td><center><img src="../../HRMS/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>

<tr rowspan="6">
        <td>Question Name</td>
        <td colspan="5"><input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $row[0]; ?>">
		<select name="qn_name" id="qn_name" class="form-control" required>
		<?php 
		$qid=$row[1];
		$que1=$con->query("SELECT * FROM question_name_master where id='$qid'");
		$answer1 = $que1->fetch(PDO::FETCH_ASSOC)
		?>
		
		<option value="<?php echo $qid;?>"><?php echo  $answer1['name']; ?></option>
<?php 
$que=$con->query("SELECT * FROM question_name_master where status='1' and id !='$qid'");
 while($answer = $que->fetch(PDO::FETCH_ASSOC))
      {     
?>
<option value="<?php echo $answer['id'];?>"><?php echo $answer['name'];?></option>
<?php
	  }
	  ?>
	  </select >
		</td>
        </tr>
        
		
        <tr>
        <td>Section</td>
        <td colspan="5"><select name="section" id="section" class="form-control" required>
		<?php
		$sid=$row[2];		
		$ques=$con->query("SELECT * FROM section_master where id='$sid'");
		$answers = $ques->fetch(PDO::FETCH_ASSOC);
		?>
		<option value="<?php echo $sid;?>"><?php echo $answers['name']; ?></option>
<?php 
$que11=$con->query("SELECT * FROM section_master where status='1' and id !='$sid'");
 while($answer11 = $que11->fetch(PDO::FETCH_ASSOC))
      {
     
?>
<option value="<?php echo $answer11['id'];?>"><?php echo $answer11['name'];?></option>
<?php
	  }
	  ?>
	  </select>
		</td>
        </tr>
<tr rowspan="6">
<td >Question</td>
<td colspan="5">
<textarea class="form-control" id="Questions" name="Questions" ><?php echo  $row[3]; ?></textarea></td>
</tr>

<tr rowspan="6">
<td >Option A</td>
<td colspan="5"><input type="text" class="form-control" id="Option_A" name="Option_A" value="<?php echo  $row[4]; ?>"></td>
</tr>
<tr rowspan="6">
<td>Option B</td>
<td colspan="5"><input type="text" class="form-control" id="Option_B" name="Option_B" value="<?php echo  $row[5]; ?>"></td>
</tr>
<tr>
<td>Option C</td>
<td colspan="1"><input type="text" class="form-control" id="Option_C" name="Option_C" value="<?php echo  $row[6]; ?>"></td>
</tr>
<tr>
<td>Option D</td>
<td colspan="1"><input type="text" class="form-control" id="Option_D" name="Option_D" value="<?php echo  $row[7]; ?>"></td>
</tr>
<tr>
<td>Answer Key</td>
<td colspan="5"><input type="text" class="form-control" id="answer_key" name="answer_key" value="<?php echo  $row[8]; ?>"></td>
</tr>
<tr>

<td>Status</td>
<td colspan="5">
<select id="status" name="status" class="form-control" >
 
<?php 
if($row[9] ==1)
{
?>
    <option value="1">Active</option>
	 <option value="2"> IN Active</option>
<?php }else {?>
  <option value="2"> IN Active</option>
  <option value="1">Active</option>
<?php } ?>
</select>
</td>
</tr>

</table>
<input type="button" class="btn btn-primary btn-md"  style="float:right;" name="Update" onclick="question_update()" value="Update"> 
</form>
</div>
</div>
</div>
<script>
	function back_ctc()
	{
		$.ajax({
		type:"POST",
		url:"HRMS/assesment_question/new.php",
		success:function(data){
		$("#main_content").html(data);
		}
		})
	}
    function question_update()
    {
    var id=$('#get_id').val();
	//alert(id);
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data:"id="+id, data,
    url:'HRMS/assesment_question/update.php',
    success:function(data)
    {
      if(data==1)
      { 
        alert('Not updated');
      
      }
      else
      {
        alert("Update Successfully");
		//question_managements()
      }
      
    }       
    });
    }
    </script>