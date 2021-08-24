<?php
require '../../connect.php';
?>

<form action="/action_page.php">
<center><h3  style="margin-left: 0px;font-weight: bold;font-size: 18px;">Payslip</h3></center>
<br>
<div>
<br>
<br>
<div>
  <label for="payroll" style="font-weight: 800;">Payroll Month : </label>
  <input type="date" style="font-weight: 800;" id="month" name="month">
 <?php
		   $year=date('Y');
         $sql=$con->query("SELECT id,year,month,date when flag=1 FROM payroll_master");
		   
          $i=1;
          while($res = $sql->fetch(PDO::FETCH_ASSOC))
          { 
          ?>
  <?php echo date('d-m-Y',strtotime($res['start_time'])); ?>
  <?php
           $i++;
          } 
          ?>
  </div>
  <br>
  <br>
  
 <div>
 
   <label for="code" style="font-weight: 800;">Employee Master :</label>
   <?php
		   $year=date('Y');
         $sql=$con->query("SELECT id,name, start_time, end_time when status=1 then 'Active' else 'InActive' end as status FROM employee_master WHERE status=1");
		   
          $i=1;
          while($res = $sql->fetch(PDO::FETCH_ASSOC))
          { 
          ?>
  <select name="code" id="code" style="font-weight: 800;">
    echo '<option value=" '.$code.'"  >'.$code.'</option>';
  </select>
  </div>
  <?php echo date('d-m-Y',strtotime($res['end_time'])); ?></td>
  </div>

  <div>
  <br>
  <br>
  <center><button type="button" id="onclick" onclick="payslip()" style="position: relative;top: -110px;width: 117px;color: black;font-weight: 900;">Go</button>
  </div>
 
</form>

<form id="forms" enctype="multipart/type" style="display:none;">
<div id="demo"  style="background-color: white;">
 <tr height="100px" style='background-color: #c2d69b'>
                <td colspan='4'>
                  <img height="90px" src="\Recruitment\image\userlog/bb 11 31.png" style="width: 285px;height: 177px;">
                <td colspan='4' class="companyName"><h1 style ="text-align: end;margin-top: -108px;">BLUEBASE SOFTWARE SERVICES PVT LTD</h1></td>
              </tr>
  <hr style="
    color: black;
    border-block-width: unset;
">
            <h1>
                <center style="font-size:20px;padding-right: 220px;font-weight:900;">(New no 80,Old no 118,Anna salai manikam lane,Guindy,Chennai-600032)</center>
            </h1>
			<h1>
                <center style="font-size:20px;padding-right: 220px;">January 2021</center>
            </h1>
            <div class="" style="margin-left: -143px; border: 1px solid black; font-weight: bold; padding: 15px 5px;">
			
  <?php
      $payslip=$con->query("SELECT * FROM `payroll_salary_master` where id=2");
     $cnt=1;
      while($payslip_master = $payslip->fetch(PDO::FETCH_ASSOC))
      {
     
      ?>
                <div class="row">
			
                    <br>
                    <div class="col-md-3" style=" font-weight: bold;">
                        &nbsp Employee Name
                    </div>
                    <div class="col-md-3" style=" font-weight: bold;text-transform: uppercase">
                        <?php echo $payslip_master["emp_name"]; ?> 
                    </div>
                    <div class="col-md-3" style="font-weight: bold;">
                        &nbsp Date Of Joined
                    </div>
                    <div class="col-md-3" style=" font-weight: bold;text-transform: uppercase;text-align: right;padding-right: 21px;">
                        <?php echo $payslip_master["date"]; ?>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3" style=" font-weight: bold;">
                        &nbsp Employee Code
                    </div>
                    <div class="col-md-3" style=" font-weight: bold;text-transform: uppercase">
                         <?php echo $payslip_master["emp_new_code"]; ?>
                    </div>
					<div class="col-md-3" style="font-weight: bold;">
                        &nbsp Bank Account Number
                    </div>
                    <div class="col-md-3" style=" font-weight: bold;text-transform: uppercase;text-align: right;padding-right: 21px;">
                        15-03-2021
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3" style=" font-weight: bold;">
                          &nbsp Designation
                    </div>
                    <div class="col-md-3" style=" font-weight: bold;text-transform: uppercase">
                       <?php echo $payslip_master["con_name"]; ?>
                    </div>
					<div class="col-md-3" style="font-weight: bold;">
                        &nbsp Total Number Of Days
                    </div>
                    <div class="col-md-3" style=" font-weight: bold;text-transform: uppercase;text-align: right;padding-right: 21px;">
                        <?php echo $payslip_master["no_of_days"]; ?>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3" style=" font-weight: bold;text-transform: uppercase">
                        &nbsp PAN No
                    </div>
                    <div class="col-md-3" style=" font-weight: bold;text-transform: uppercase">
                       FRT4856896956
                    </div>
					<div class="col-md-3" style="font-weight: bold;">
                        &nbsp Days Worked 
                    </div>
                    <div class="col-md-3" style=" font-weight: bold;text-transform: uppercase;text-align: right;padding-right: 21px;">
                        15-03-2021
                    </div>
                </div>
				<br>
				<div class="row">
                    <div class="col-md-3" style=" font-weight: bold;text-transform: uppercase">
                        &nbsp ESIC No
                    </div>
                    <div class="col-md-3" style=" font-weight: bold;text-transform: uppercase">
                        GFT4765374
                    </div>
					<div class="col-md-3" style="font-weight: bold;">
                       
                    </div>
                    <div class="col-md-3" style=" font-weight: bold;text-transform: uppercase;text-align: right;padding-right: 21px;">
                         
                    </div>
                </div>
                <?php
	  $cnt=$cnt+1;
      }
	  ?>
                <br>
               
            </div>
           
			<div class="row" style="margin-left: -9pc; margin-right: 0px;">
                <div class="col-md-6" style="border: 1px solid black;  padding: 10px 5px;font-weight: bold;text-align:center;">
                    EARNINGS
                </div>
                <div class="col-md-6" style="border: 1px solid black;  padding: 10px 5px;font-weight: bold;    text-align:center;">
                    DEDUCTIONS
                </div>
                
            </div>
            <div class="row" style="margin-left: -9pc; margin-right: 0px;">
                <div class="col-md-3" style="border: 1px solid black;  padding: 10px 5px;font-weight: bold;">
                    Basic & DA
                </div>
                <div class="col-md-3" style="border: 1px solid black;  padding: 10px 5px;font-weight: bold;    text-align: right;">
                    
                </div>
                <div class="col-md-3" style="border: 1px solid black;  padding: 10px 5px;font-weight: bold;">
                    Provident Fund
                </div>
                <div class="col-md-3" style="border: 1px solid black;  padding: 10px 5px;font-weight: bold;    text-align: right;">
                    
                </div>
            </div>
            <div class="row" style="margin-left: -9pc; margin-right: 0px;">
                <div class="col-md-3" style="border: 1px solid black;  padding: 10px 5px;font-weight: bold;">
                    H R A
                </div>
                <div class="col-md-3" style="border: 1px solid black;  padding: 10px 5px;font-weight: bold;    text-align: right;">
                    
                </div>
                <div class="col-md-3" style="border: 1px solid black;  padding: 10px 5px;font-weight: bold;">
                    
                </div>
                <div class="col-md-3" style="border: 1px solid black;  padding: 10px 5px;font-weight: bold;    text-align: right;">
                    
                </div>
            </div>
            <div class="row" style="margin-left: -9pc; margin-right: 0px;">
                <div class="col-md-3" style="border: 1px solid black;  padding: 10px 5px;font-weight: bold;">
                 Conveyance
                </div>
                <div class="col-md-3" style="border: 1px solid black;  padding: 10px 5px;font-weight: bold;    text-align: right;">
                   
                </div>
                <div class="col-md-3" style="border: 1px solid black;  padding: 10px 5px;font-weight: bold;">
                    E.S.I.
                </div>
                <div class="col-md-3" style="border: 1px solid black;  padding: 10px 5px;font-weight: bold;    text-align: right;">
                    
                </div>
            </div>
            <div class="row" style="margin-left: -9pc; margin-right: 0px;">
                <div class="col-md-3" style="border: 1px solid black;  padding: 10px 5px;font-weight: bold;">
                    Other Allowance
                </div>
                <div class="col-md-3" style="border: 1px solid black;  padding: 10px 5px;font-weight: bold;    text-align: right;">
                    
                </div>
                <div class="col-md-3" style="border: 1px solid black;  padding: 10px 5px;font-weight: bold;">
                    Loan
                </div>
                <div class="col-md-3" style="border: 1px solid black;  padding: 10px 5px;font-weight: bold;    text-align: right;">
                    
                </div>
            </div>
            <div class="row" style="margin-left: -9pc; margin-right: 0px;">
                <div class="col-md-3" style="border: 1px solid black;  padding: 10px 5px;font-weight: bold;">
                   Site Allowance
                </div>
                <div class="col-md-3" style="border: 1px solid black;  padding: 10px 5px;font-weight: bold;    text-align: right;">
                    
                </div>
                <div class="col-md-3" style="border: 1px solid black;  padding: 20px 5px; font-weight: bold;">
               Profession Tax
                </div>
                <div class="col-md-3" style="border: 1px solid black;  padding: 20px 5px;">
                </div>
            </div>
            <div class="row" style="margin-left: -9pc; margin-right: 0px;">
                <div class="col-md-3" style="border: 1px solid black;  padding: 10px 5px;font-weight: bold;">
                    Statutory Bonus
                </div>
                <div class="col-md-3" style="border: 1px solid black;  padding: 10px 5px;font-weight: bold;    text-align: right;">
                   
                </div>
                <div class="col-md-3" style="border: 1px solid black;  padding: 20px 5px;font-weight: bold;">
            club
                </div>
                <div class="col-md-3" style="border: 1px solid black;  padding: 20px 5px;">

                </div>
            </div>
			<div class="row" style="margin-left: -9pc; margin-right: 0px;">
                <div class="col-md-3" style="border: 1px solid black;  padding: 10px 5px;font-weight: bold;">
                    Pf Additional
                </div>
                <div class="col-md-3" style="border: 1px solid black;  padding: 10px 5px;font-weight: bold;    text-align: right;">
                   
                </div>
                <div class="col-md-3" style="border: 1px solid black;  padding: 20px 5px;font-weight: bold;">
            
                </div>
                <div class="col-md-3" style="border: 1px solid black;  padding: 20px 5px;">

                </div>
            </div>
			
			<div class="row" style="margin-left: -9pc; margin-right: 0px;">
                <div class="col-md-3" style="border: 1px solid black;  padding: 10px 5px;font-weight: bold;">
                   Incentives/Arrears
                </div>
                <div class="col-md-3" style="border: 1px solid black;  padding: 10px 5px;font-weight: bold;    text-align: right;">
                   
                </div>
                <div class="col-md-3" style="border: 1px solid black;  padding: 20px 5px;font-weight: bold;">
            Total Deduction
                </div>
                <div class="col-md-3" style="border: 1px solid black;  padding: 20px 5px;">

                </div>
            </div>
			<div class="row" style="margin-left: -9pc; margin-right: 0px;">
                <div class="col-md-3" style="border: 1px solid black;  padding: 10px 5px;font-weight: bold;">
                    Total
                </div>
                <div class="col-md-3" style="border: 1px solid black;  padding: 10px 5px;font-weight: bold;    text-align: right;">
                   
                </div>
                <div class="col-md-3" style="border: 1px solid black;  padding: 20px 5px;font-weight: bold;">
            NET Salary
                </div>
                <div class="col-md-3" style="border: 1px solid black;  padding: 20px 5px;">

                </div>
            </div>
           
           
            <div class="" style="margin-left: -9pc; border: 1px solid black; font-weight: bold; padding: 15px 5px;">
                <div class="row">
                    <br>
                    <div class="col-md-3" style=" font-weight: bold;">
                        
                    </div>
                    <div class="col-md-3" style=" font-weight: bold;">

                    </div>
                    <div class="col-md-3" style=" font-weight: bold;">
                       
                    </div>
                    <div class="col-md-3" style=" font-weight: bold;">

                    </div>
                </div>
                <br>
                <div class="row">
                   <h4 style="margin-top: -35px;margin-left: 20px;font-size: 18px;font-weight: 700;">Xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx hundred only</h4>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3" style=" font-weight: bold;">

                    </div>
                    <div class="col-md-3" style=" font-weight: bold;">

                    </div>
                </div>
                <br>
                <div class="row">
                   <h4 style="margin-left: 20px;font-size: 18px;margin-top: -44px;font-weight: 700;">This is a computer generated statement and does not require any signature.</h4>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-md-2" style=" font-weight: bold;">
                    </div>
                    <div class="col-md-3" style=" font-weight: bold;  text-decoration: underline;">

                    </div>
                    <div class="col-md-2" style=" font-weight: bold;">
                    </div>
                    <div class="col-md-3" style=" font-weight: bold;  text-decoration: underline;">

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</form>



