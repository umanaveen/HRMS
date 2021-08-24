<?php
require '../../../connect.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("select * from interview_rounds where id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();
$sta=$row['status'];
?>
     <div class="card card-info">
              <div class="card-header">
                
				              <center><h3 class="card-title"><b>Intrerview Round </b></h3></center>
		<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
              </div>

<form role="form" name="" action="" method="post" enctype="multipart/type">
<table class="table table-bordered">
 <tr>
        <td><center><img src="/HRMS/HRMS/Recruitment/image/userlog/bluebase.png"  style="width:300px;height:150px;"></center></td>
        <td colspan="5"><center><h1><b>Bluebase Software services Pvt Ltd</b></h1></center></td>
        </tr>
<tr>
<td>Name:</td>
<td colspan="5">
<input type="hidden" class="form-control" id="id" name="id" value="<?php echo  $id;?>">
<input type="text" class="form-control" id="name" name="name" value="<?php echo  $row['name'];?>">
</td>
</tr>


<tr>
<td>Status</td>
<td colspan="2">

<select class="form-control" name="status" id="status">
<?php

if($sta==0)
{
	?>
<option value="0">InActive</option>
<option value="1">Active</option>
<?php	
}
else{
	?>
	<option value="1">Active</option>
	<option value="0">InActive</option>
	<?php
}
?>

</select>
</td>
</tr>
  <table class="table table-bordered">
<h3><center>Interview Feedback</center></h3>
<tbody>

<?php

$sql=$con->query("SELECT interview_rounds.id as interview_rounds_id,interview_round_name.id as name_id,interview_rounds.*,interview_round_name.* FROM `interview_rounds` 
INNER JOIN interview_round_name ON interview_rounds.id=interview_round_name.inter_id
where interview_rounds.id='$id'");
$cnt=0;
while($rows = $sql->fetch(PDO::FETCH_ASSOC))
{
?>
<tr>
<input type="hidden" class="form-control" id="count" name="count[]"  value="<?php echo count($cnt);?>" readonly>
<input type="hidden" class="form-control" id="get_id" name="get_id<?php echo $cnt; ?>" value="<?php echo   $rows['name_id']; ?>">

<td><?php echo  $rows['name']; ?></td>
<td><input type="text" class="form-control" id="section_name1" name="section_name<?php echo $cnt; ?>" value="<?php echo  $rows['Sec_name']; ?>" ></td>


</tr>
<?php 
$cnt++;
 }?>
 </tbody>
 
      </table>
</table>


<input type="button" class="btn btn-primary btn-md"  style="float:right;" name="Update" onclick="round_update()" value="Update"> 

</form>
</div>

<script>
 function round_update()
    {
    var id=$('#id').val();
	var get_id=$('#get_id').val();
	alert(id);
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
   // data:'id='+id+'&get_id='+get_id+'&data='+data,
	  data:"id="+id+"&get_id="+get_id, data,
	// data: 'value1='+val1+'&value2='+val2,
    url:'HRMS/masters/interview_rounds/update_interview_rounds.php',

    success:function(data)
    {
      if(data==1)
      { 
        alert('Not updated');
      
      }
      else
      {
        alert("Update Successfully");
		interview_rounds()
      }
      
    }       
    });
    }
	
	function back()
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/masters/interview_rounds/interview_rounds.php",
    success:function(data){
 $("#main_content").html(data);
    }
    })
  }
	</script>