<?php
require '../../connect.php';
?>
<div class="content-wrapper" id="main_content">
<div class="container-fluid">
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-table"></i> Recruitment Master
	  <input type="button" style="float:right;" class="btn btn-warning" name="print" onclick="printDiv('printableArea')"  value="Print">
	  </div>
    <div class="card-body" id="printableArea">
	 <form method="POST" action="Recruitment/Recruitment/new_submit.php" enctype="multipart/type">
	</form>
    </div>
  </div>
</div>
</div> 
<?php 

//call emp_personal_insert ('aswini','krishna','1996-10-04','chennai','kadapa','8888888','aswini@gmail.com','23477643','rr567788','52432','qwet','1','1','2020-09-09 13:08:52');


//call emp_qualification_insert('UG','VBIT college','btech','ece',2018,85.00,'aswinuwefjpg',1,'2020-09-09 13:08:52',1);

?>