<?php
require '../../connect.php';
include("../../user.php");
$userid=$_SESSION['userid'];
$cid=$_REQUEST['cid'];
$rid=$_REQUEST['rid'];
$round_type=$_REQUEST['round_type'];
$qn_name=$_REQUEST['qn_name'];
$allocate_person=$_REQUEST['allocate_person'];
$status=1;
if($allocate_person=='')
{	
 $ins=$con->query("insert into candidate_round_details(candid_id,round_id,qn_id,status,created_by,created_on)values('$cid','$round_type','$qn_name','4','$userid',now())");
echo "insert into candidate_round_details(candid_id,round_id,qn_id,status,created_by,created_on)values('$cid','$round_type','$qn_name','4','$userid',now())"; 

$upd=$con->query("update candidate_form_details set status=4 where id='$cid' and status=2");
echo "update candidate_form_details set status=4 where id='$cid' and status=2";

$iupd=$con->query("update interview_schedule_detail set status=2 where id='$rid'");
}
else
{	
 $ins=$con->query("insert into candidate_round_details(candid_id,round_id,person_id,status,created_by,created_on)values('$cid','$round_type','$allocate_person','3','$userid',now())");
echo "insert into candidate_round_details(candid_id,round_id,person_id,status,created_by,created_on)values('$cid','$round_type','$allocate_person','3','$userid',now())";

$upd=$con->query("update candidate_form_details set status=3 where id='$cid'");
echo "update candidate_form_details set status=3 where id='$cid' and status=2";
$iupd=$con->query("update interview_schedule_detail set status=2 where id='$rid' ");
}

if($upd)
{
	echo"<script>alert('Allocated successfully');</script>";
	interview_candidate_list();
}
?>
<?php
/* 
$mail = new PHPMailer;
$mail->IsSMTP(); 
$mail->Mailer = "smtp";
$mail->Host = "smtp.zoho.com";                                    // Set mailer to use SMTP
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'hr@bluebase.in';                 // SMTP username
$mail->Password = 'Quad@321';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted
$mail->Port = 465;
$mail->From = 'hr@bluebase.in';
$mail->FromName = 'HRMS Job Portal';
$mail->addAddress("laxmipriya@bluebase.in");     // Add a recipient
$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->isHTML(true);     
$header='Dear&nbsp;&nbsp;'. $user_name.',  <br> 
		&nbsp;&nbsp;	This Mail regarding your details for Job confirmation.Below Given Login credentials and User Details to login the application please upload document for document verification.
			 <table class="table table-hover table-bordered"  border=1 style="margin: 15px 0 98px 0px!important;"><thead style="color:#0033FF;">					
			<tr style="text-align:center;">			
			<th style="font-size:15px;">#</th>
			<th style="font-size:15px;">User Name</th>
			<th style="font-size:15px;">Password</th> 
			<th style="font-size:15px;" >Contact Number</th>
			</tr>	
			</thead>
			<tr>
				<td>' . "1".'</td>
				<td>' . $user_name.'</td>
				<td>' . "Welcome@123".'</td> 
				<td>' . $phone.'</td>
			</tr>
			<button class="btn btn-primary"><a href="http://115.249.95.118:8081/hrms">Login Portal</a></button>
			<h4>Thanks & Regards,</h4><br>
	<p>Recruitment</p>
			</table>';                            // Set email format to HTML
$subject="HRMS - Candidate Personal Details Required";		
		
	$mail->Subject =$subject;
	$mail->Body =$header;
	
/* 	$mail_recruiter=16;
$sql2= $con->query("Update technical_team_details set head_status='$mail_recruiter' where candidate_id='$user_id'");
$sql2= $con->query("Update z_user_master set user_group_code='ROLE-007' where candidate_id='$user_id'");
$sql1= $con->query("Update recruiter_details set status_recruiter='$mail_recruiter' where candidate_id='$user_id'");
$sql3= $con->query("Update candidate_form_details set status='$mail_recruiter' where id='$user_id'");
$sql4= $con->query("Update ctc_approval_table set status='$mail_recruiter' where candidate_id='$user_id'");
$sql4= $con->query("Update md_commands set status='$mail_recruiter' where candidate_id='$user_id'");
 */
/* if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
	echo "0";
} 
else {
    echo 'Message has been sent';
	echo "1";
}  */
?>