<?php 
require '../../connect.php';
require '../../user.php';
  $octc=$_POST['octc'];
  $doj=$_POST['doj'];
  $mailid=$_POST['mailid'];
  $name=$_POST['name'];
  
require '../../mail/PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;
$mail->IsSMTP(); 
$mail->Mailer = "smtp";
$mail->Host = "smtp.zoho.com";                                    // Set mailer to use SMTP
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'balachandar.s@bluebase.in';                 // SMTP username
$mail->Password = 'Blackmark@321';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted
$mail->Port = 465;

$mail->From = 'balachandar.sarvesan@gmail.com';
$mail->FromName = 'HRMS';
$mail->addAddress('balachandar.s@bluebase.in');     // Add a recipient

$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
/* $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name */
$mail->isHTML(true);                                 // Set email format to HTML

$subject="HRMS";			
				$html_table = 'Dear <?php $name; ?>  ,<br><br>
							   This the reference of Job confirmatioon letter.
					<table class="table table-hover table-bordered"  border=1 style="margin: 15px 0 98px 0px!important;">   
					<thead style="color:#0033FF;">					
						<tr style="text-align:center;">			
							<th style="font-size:15px;">#</th>
							<th style="font-size:15px;">Name</th>
							<th style="font-size:15px;">Join DATE</th>
							<th style="font-size:15px;" >Offerec Salary</th>
						</tr>	
					</thead>';
					/* 
						$row= mysqli_query($con, "SELECT * FROM item_master where expiry_date in(select date(DATE_ADD(NOW(), INTERVAL 30 DAY)))");
						$s=1;
						 "bala";
							while($type=mysqli_fetch_array($row))
							{
								
							$po_dates=$type['po_date']; $po_date=date("d-m-Y",strtotime($po_dates));
							$expiry_dates=$type['expiry_date']; $expiry_date=date("d-m-Y",strtotime($expiry_dates));
							$fa_serial_no=$type['fa_serial_no'];
							$category=$type['category'];
							$category_description=$type['category_description'];
							$location=$type['location'];
								
						$html_table .=' */
							'<tr>
									<td> . 1.</td>
									<td> . $name.</td>
									<td> . $doj.</td>
									<td> . $octc.</td>
							  </tr>'; 
							 
				$html_table .=' </table>';
				$html_table .='<button class="btn btn-primary"><a href="assetserver.quadsel.in/asset_temp/mail/pdf_report.php">Generate PDF</a></button>';
				$html_table .=' <h4>Thanks & Regards,</h4><br>
				<p>HRMS</p>';

				$mail->Subject =$subject;
				$mail->Body =$html_table;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} 
else {
    echo 'Message has been sent';
}
?>