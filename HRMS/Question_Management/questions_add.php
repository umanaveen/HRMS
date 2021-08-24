<?php
require '../../connect.php';
?>

  <div class="card card-info">
              <div class="card-header">
			 <center><h3 class="card-title"><b> QUESTIONS  Add</b></h3></center>
			<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger">Back</a>
</div>


    <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
        <tr>
        <td><center><img src="/HRMS/HRMS/Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
        <td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
        </tr>
      
        <tr>
        <td colspan="6"><center><b>Add Questions</b></center></td>
        </tr>
		<tr>
        <td>Question Name</td>
        <td colspan="5"><select name="qn_name" id="qn_name" class="form-control" required>
		<option value="">Select Qn Name</option>
<?php 
$que=$con->query("SELECT * FROM question_name_master where status='1'");
 while($answer = $que->fetch(PDO::FETCH_ASSOC))
      {
     
?>
<option value="<?php echo $answer['id'];?>"><?php echo $answer['name'];?></option>
<?php
	  }
	  ?>
		</td>
        </tr>
        <tr>
		
        <tr>
        <td>Section</td>
        <td colspan="5"><select name="section" id="section" class="form-control" required>
		<option value="">Select Section</option>
<?php 
$que1=$con->query("SELECT * FROM section_master where status='1'");
 while($answer1 = $que1->fetch(PDO::FETCH_ASSOC))
      {
     
?>
<option value="<?php echo $answer1['id'];?>"><?php echo $answer1['name'];?></option>
<?php
	  }
	  ?>
		</td>
        </tr>
        <tr>
        
        <tr>
        <td>Questions</td>
        <td colspan="5"><textarea  class="form-control" id="Questions"  placeholder="Enter Questions" name="Questions"></textarea></td>
        </tr>
        <tr>
        <td>Option A</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Option_A" id="Option_A" name="Option_A" ></td>
        </tr>
        <tr>
       <td>Option B</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Option_B" id="Option_B" name="Option_B" ></td>
        </tr>
        <tr>
        <td>Option C</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Option_C" id="Option_C" name="Option_C" ></td>
        </tr>
        
         <tr>
        <td>Option D</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Option_D" id="Option_D" name="Option_D" ></td>
        </tr>
		 <tr>
        <td>Correct Answer Key</td>
        <td colspan="5">
			<input type="text"  id="answer_key" name="answer_key" class="form-control"  placeholder="Enter Correct Answer" required="true">
		</td>
        </tr>
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="insert_questions()" value="save"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>

    <script>
    function insert_questions()
    {
    var id=0;
	alert(id);
    var data = $('form').serialize();
	
     $.ajax({
    type:'GET',
    data:"id="+id, data,
    url:'HRMS/Question_Management/insert_questions.php',
	
    success:function(data)
    {
      
        alert("Entry Successfully");
		 question_managements();
          
    }       
    }); 
    }
	
	/* function back_ctc()
	{
		question_managements();
	} */
    </script>
