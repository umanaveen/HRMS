<?php require '../../connect.php'; require '../../user.php'; $id=$_REQUEST['id'];  
$deatsils=$con->query("SELECT cfd.first_name,cfd.phone,cfd.id FROM `candidate_form_details` cfd join z_user_master zud on cfd.id=zud.candidate_id where cfd.id='$id'");
$data=$deatsils->fetch();
$user_id=$data['id'];
   $user_name=$data['first_name'];
   $phone=$data['phone']; 
require '../../PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;
$mail->IsSMTP(); 
$mail->Mailer = "smtp";
$mail->Host = "smtp.zoho.com";                                    // Set mailer to use SMTP
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'balachandar.s@bluebase.in';                 // SMTP username
$mail->Password = 'Blackmark@321';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted
$mail->Port = 465;
$mail->From = 'balachandar.s@bluebase.in';
$mail->FromName = 'HRMS Job Portal';
$mail->addAddress("laxmipriya@bluebase.in");     // Add a recipient
$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->isHTML(true);                                 // Set email format to HTML
$subject="HRMS - Candidate Personal Details Required";			
	$html_table = 'Dear&nbsp;&nbsp;'. $user_name.',  <br> 
		&nbsp;&nbsp;	This Mail regarding your details for Job confirmation.Below Given Login credentials and User Details to login the application please upload document for document verification.
			 <table class="table table-hover table-bordered"  border=1 style="margin: 15px 0 98px 0px!important;">   
			<thead style="color:#0033FF;">					
			<tr style="text-align:center;">			
			<th style="font-size:15px;">#</th>
			<th style="font-size:15px;">User Name</th>
			<th style="font-size:15px;">Password</th> 
			<th style="font-size:15px;" >Contact Number</th>
			</tr>	
			</thead>';
		$html_table .='<tr>
									<td>' . "1".'</td>
									<td>' . $user_name.'</td>
									<td>' . "Welcome@123".'</td> 
									<td>' . $phone.'</td>
							  </tr>'; 
	$html_table .=' </table>';
	$html_table .='<button class="btn btn-primary"><a href="http://49.249.229.14/HRMS">Login Portal</a></button>';
	$html_table .=' <h4>Thanks & Regards,</h4><br>
	<p>HRMS</p>';
	$mail->Subject =$subject;
	$mail->Body =$html_table;
	
	$mail_recruiter=16;
$sql2= $con->query("Update technical_team_details set head_status='$mail_recruiter' where candidate_id='$user_id'");
$sql2= $con->query("Update z_user_master set user_group_code='ROLE-007' where candidate_id='$user_id'");
$sql1= $con->query("Update recruiter_details set status_recruiter='$mail_recruiter' where candidate_id='$user_id'");
$sql3= $con->query("Update candidate_form_details set status='$mail_recruiter' where id='$user_id'");
$sql4= $con->query("Update ctc_approval_table set status='$mail_recruiter' where candidate_id='$user_id'");
$sql4= $con->query("Update md_commands set status='$mail_recruiter' where candidate_id='$user_id'");

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
	echo "0";
} 
else {
    echo 'Message has been sent';
	echo "1";
}
?>