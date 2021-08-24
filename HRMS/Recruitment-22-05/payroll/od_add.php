<?php
require '../../connect.php';
?>
<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header">
<i class="fa fa-table"></i> OD  Add
<a onclick="return back_od()" style="float: right;" data-toggle="modal" class="btn btn-primary"></i>Back</a>
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
        <td colspan="6"><center><b>Add OD</b></center></td>
        </tr>
        <tr>
        <td>Date</td>
            <td colspan="5"><input type="date" class="form-control"  id="date" name="date" ></td>
        </tr>
        <tr>
							<td>Employee Name</td>
							<td><select name="Employee_name" id="Employee_name" class="form-control">
<option value="">Select Employee</option>
<?php
$emp_sql=$con->query("SELECT * FROM employee_master ");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
		  ?>
		  <option value="<?php echo $emp_res['id'];?>"><?php echo $emp_res['name'];?></option>
		  <?php
	  }
		  ?>
		  </select></td>
						</tr>	
        <tr>
       <td>Customer Name</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Customer Name" id="Customer_name" name="Customer_name"></td>
        </tr>
       <tr>
       <td>Location</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Location" id="Location" name="Location"></td>
        </tr>
               <tr>
       <td>Purpose</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Purpose" id="Purpose" name="Purpose"></td>
        </tr>
       
		 
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="insert_od()" value="save"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>

    <script>
	function back_od()
	{
		$.ajax({
		type:"POST",
		  url:"Recruitment/payroll/od.php",
		success:function(data){
		$("#main_content").html(data);
		}
		})
	}
    function insert_od()
    {
    var id=0;
	//alert(id);
    var data = $('form').serialize();
	//alert(data);
    $.ajax({
    type:'GET',
    data:"id="+id, data,
    url:'Recruitment/payroll/insert_od.php',
	
    success:function(data)
    {
      
        alert("Entry Successfully");
od()
      
      
    }       
    });
    }
    </script>
