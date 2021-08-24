<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">Holiday  Add</font></h3>
				<input type="button" style="float:right;" class="btn btn-danger" name="back" value="BACK" onclick="back_holiday()">
				
              </div>
    <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
        <tr>
       <td><center><img src="/HRMS/HRMS/Recruitment/image/userlog/bluebase.png"  style="width:300px;height:150px;"></center></td>
      <td colspan="5"><center><h1><b>Bluebase Software services Pvt Ltd</b></h1></center></td>
        </tr>
      
        <tr>
        <td colspan="6"><center><b>Add Holiday</b></center></td>
        </tr>
        <tr>
        <td>Year</td>
                <td colspan="5"><input type="text" class="form-control" placeholder="Year" id="Year" name="Year" ></td>
        </tr>
        <tr>
        <td>Date</td>
        <td colspan="5"><input type="date" class="form-control"  id="date" name="date" ></td>
        </tr>
        <tr>
       <td>Holiday Name</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Holiday Name" id="holiday_name" name="holiday_name"></td>
        </tr>
      
        
       
		 
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="insert_holiday()" value="save"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
        </div>

    <script>
	function back_holiday()
	{
		$.ajax({
		type:"POST",
		url:"HRMS/payroll/holiday.php",
		success:function(data){
		$("#main_content").html(data);
		}
		})
	}
    function insert_holiday()
    {
    var id=0;
	//alert(id);
    var data = $('form').serialize();
	//alert(data);
    $.ajax({
    type:'GET',
    data:"id="+id, data,
    url:'HRMS/payroll/insert_holiday.php',
	
    success:function(data)
    {
      
        alert("Entry Successfully");
holidays()
      
      
    }       
    });
    }
    </script>
