<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header">
<i class="fa fa-table"></i> Holiday  Add
<a onclick="return back_holiday()" style="float: right;" data-toggle="modal" class="btn btn-primary"></i>Back</a>
</div>
<div class="card-body">
<div class="tab-content">

    <div class="active tab-pane" id="for_employment">
    <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
        <tr>
        <td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
        <td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
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
		url:"Recruitment/payroll/holiday.php",
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
    url:'Recruitment/payroll/insert_holiday.php',
	
    success:function(data)
    {
      
        alert("Entry Successfully");
holidays()
      
      
    }       
    });
    }
    </script>
