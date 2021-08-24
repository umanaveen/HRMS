<?php
require '../../../connect.php';
require '../../../user.php';
require 'PHPMailer/PHPMailerAutoload.php';
require 'class/class.phpmailer.php';
include ('pdf.php');
echo $staff_id=$_REQUEST['id'];
?>
<?php 
/* for($i=0;$i<$count;$i++)
{  
 */
   
	
	$staff_query= $con->query("select a.id as staff_id,b.full_name,b.user_name,b.password,b.email_id from staff_master a  inner join z_user_master b on (b.candidate_id=a.candid_id) where a.id = '$staff_id' "); 
	//echo "select a.id as staff_id,b.full_name,b.user_name,b.password,b.email_id from staff_master a  inner join z_user_master b on (b.candidate_id=a.candid_id) where a.id = '$staff_id' ";
	
	$staff_query->execute(); 
	$row        = $staff_query->fetch();	
	$FULLNAME       = $row['full_name'];
    $SENDMAIL       = $row['email_id'];
    $USERNAME       = $row['user_name'];
    $PASSWORD  ="Welcome@123";
   
	$mail = new PHPMailer;	
	$mail->SMTPDebug = 3; 
	$mail->IsSMTP(true);								//Sets Mailer to send message using SMTP
	$mail->Host = 'smtp.zoho.com';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
	$mail->Port = '465';								//Sets the default SMTP server port
	$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
	$mail->Username = 'umadevi.v@bluebase.in';					//Sets SMTP username
	$mail->Password = 'uma@naveen';					//Sets SMTP password
	$mail->SMTPSecure = 'ssl';							//Sets connection prefix. Options are "", "ssl" or "tls"
	$mail->From = 'umadevi.v@bluebase.in';			//Sets the From email address for the message
	 $mail->FromName = 'Bluebase';			//Sets the From name of the message
	 echo $mail->AddAddress('ammudevi284@gmail.com', $FULLNAME);		//Adds a "To" address
		
	$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
	$mail->IsHTML(true);							//Sets message type to HTML				
	 				//Adds an attachment from a path on the filesystem
	$mail->Subject = 'Login Details';			//Sets the Subject of the message
					//An HTML or plain text message body
	
	$mail->Body = "Dear \r\n".$FULLNAME.""." ,"."\r\n\r\n<br/><br/><br/><br/>";	
	$mail->Body .= "  Kindly find the below link and credential to fill the employee form and attach the documents with in 48 hrs of receiving this mail."."\r\n\r\n<br/><br/><br/>";
	$mail->Body .= "Url : http://115.243.95.118:8081/hrms/"."\r\n\r\n<br/><br/><br/>";	
	$mail->Body    .= "USERNAME : ".$USERNAME."\r\n\r\n<br/>"; 
	$mail->Body   .= "PASSWORD : ".$PASSWORD."\r\n\r\n<br/>";
	
	if(!$mail->send()) {
       echo 'Message could not be sent.';
       echo 'Mailer Error: ' . $mail->ErrorInfo;
	   echo "0";
   } 
    else {
        $message = '<label class="text-success">UserName and PassWord has been send successfully...</label>';echo $message;
	   // $update_query = $con->query("update quotation_entry set flag ='1' , modified_by ='$user_id',modified_on =NOW() WHERE quote_no= '$QuoteNo'");  
		//echo "update quotation_entry set flag ='1' , modified_by ='$user_id',modified_on =NOW() WHERE quote_no= '$QuoteNo'";
	
	}
	//unlink($file_name);

	 
//}	
     //$mail->clearAttachments();

?>