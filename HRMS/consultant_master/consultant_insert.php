<?php
require '../../connect.php';
include("../../user.php");
require '../../PHPMailer/PHPMailerAutoload.php';
require 'class/class.phpmailer.php';
include ('pdf.php');
$user=$_SESSION['candidateid'];


$C_name=$_REQUEST['C_name'];
$org_name=$_REQUEST['org_name'];

$phone=$_REQUEST['phone'];
$whatsapp=$_REQUEST['whatsapp'];
$mail=$_REQUEST['mail'];
$alt_mail=$_REQUEST['alt_mail'];
$Percentage=$_REQUEST['Percentage'];
$cer_status=$_REQUEST['cer_status'];

$password=md5("Welcome@123");
$fullname=$C_name."-".$org_name;
$user_group_code='R020';//CONSULTANT

  $query=$con->query("INSERT INTO `consultant_master`(`consultant_name`, `con_org`, `phn_no`, `alt_phno`, `email`, `alt_email`, `percentage`, `status`) VALUES('$C_name','$org_name','$phone','$whatsapp','$mail','$alt_mail','$Percentage','$cer_status')");  
 
 $qsel=$con->query("select * from consultant_master order by consultant_id desc limit 1");
 $qfet=$qsel->fetch();
 $consultant_id=$qfet['consultant_id'];
 

$ins=$con->query("insert into z_user_master(consultant_id,user_name,password,full_name,status,email_id,user_group_code,mobile_no,created_by,created_on)values('$consultant_id','$phone','$password','$fullname','1','$mail','$user_group_code','$phone','$user',now()) ");

/*if($query)
{
	echo 0;
}
else
{
	echo 1;
} */ 
?>

<?php 
 
	
	$FULLNAME       =  $fullname;
     $SENDMAIL       = $mail;
    $USERNAME       = $phone;
    $PASSWORD  ="Welcome@123";
   
   
	$mail = new PHPMailer;	
	$mail->SMTPDebug = 3; 
	$mail->IsSMTP(true);								//Sets Mailer to send message using SMTP
	$mail->Host = 'smtp.zoho.com';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
	$mail->Port = '465';								//Sets the default SMTP server port
	$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
	$mail->Username = 'rajeshwari@bluebase.in';					//Sets SMTP username
	$mail->Password = 'June@2906#';					//Sets SMTP password
	$mail->SMTPSecure = 'ssl';							//Sets connection prefix. Options are "", "ssl" or "tls"
	$mail->From = 'rajeshwari@bluebase.in';			//Sets the From email address for the message
	 $mail->FromName = 'Bluebase';			//Sets the From name of the message
	 echo $mail->AddAddress($SENDMAIL, $FULLNAME);		//Adds a "To" address
		
	$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
	$mail->IsHTML(true);							//Sets message type to HTML				
	 				//Adds an attachment from a path on the filesystem
	$mail->Subject = 'Login Details';			//Sets the Subject of the message
					//An HTML or plain text message body
		
	$mail->Body .= "An account has been created for you in the Kerli Software at Bluebase Software Services Private Limited. This account will enable you to submit candidates on job requisitions. Kindly use the following Credentials:"."\r\n\r\n<br/><br/>";
	$mail->Body .= "Url : http://115.243.95.118:8081/hrms/"."\r\n\r\n<br/><br/>";	
	$mail->Body    .= "USERNAME : ".$USERNAME."\r\n\r\n<br/>"; 
	$mail->Body   .= "PASSWORD : ".$PASSWORD."\r\n\r\n<br/><br/><br/>";
	$mail->Body   .= "Regards"."\r\n\r\n<br/>";
	$mail->Body   .= "Rajeshwari"."\r\n\r\n<br/>";
	$mail->Body   .= "+91 98414 16638"."\r\n\r\n<br/>";
	
	if(!$mail->send()) 
	{
       echo 'Message could not be sent.';
       echo 'Mailer Error: ' . $mail->ErrorInfo;
	   echo "0";
    } 
    else 
	{
        $message = '<label class="text-success">UserName and PassWord has been send successfully...</label>';echo $message;
	   // $update_query = $con->query("update quotation_entry set flag ='1' , modified_by ='$user_id',modified_on =NOW() WHERE quote_no= '$QuoteNo'");  
		//echo "update quotation_entry set flag ='1' , modified_by ='$user_id',modified_on =NOW() WHERE quote_no= '$QuoteNo'";
	
	}
	?>