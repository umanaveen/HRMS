<?php 
require '../../../connect.php';
include("../../../user.php");
require '../../../PHPMailer/PHPMailerAutoload.php';
require 'class/class.phpmailer.php';
include ('../pdf.php');
$userid=$_SESSION['userid'];
$jid=$_REQUEST['jid'];
$consid=$_REQUEST['allocate'];
$cou=count($consid);
for($i=0;$i< $cou;$i++)
{
$ins=$con->query("insert into jd_allocation(jd_id,consultant_id,status,created_by,created_on)values('$jid','$consid[$i]',1,'$userid',now())");
}

$upd=$con->query("update jobdescription_form_details set status=2 where id='$jid'");

if($upd)
{
	//echo 0;
}
?>

<?php
$imp=implode(',',$consid);

 $consl_query= $con->query("select * from z_user_master u join consultant_master c on u.consultant_id=c.consultant_id where u.consultant_id in($imp) ");
 while($row= $consl_query->fetch() )

 {
	 $FULLNAME       =  $row['full_name'];;
     $SENDMAIL       = $row['email_id'];
     $USERNAME       = $row['user_name'];
    $PASSWORD  ="Welcome@123";
	
	
   //$dt = new DateTime($interview_date);
 //$iterdate=$dt->format('M j Y g:i A');


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
	 $mail->AddAddress($SENDMAIL, $FULLNAME);		//Adds a "To" address
		
	$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
	$mail->IsHTML(true);							//Sets message type to HTML				
	 				//Adds an attachment from a path on the filesystem
	$mail->Subject = 'New JD';			//Sets the Subject of the message
					//An HTML or plain text message body
	
	$mail->Body = "Bluebase Software Services Private Limited has been shared a Job Description with you. Please login by clicking on 'Kerli Software'. You can Submit Candidates Profile for Further Processing. Contact your Bluebase Software Services Private Limited recruiting partner for further guidance.<br><br>";	
	
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
 }
	
   
   //$iterdate=date('Y-m-d H:i:s', strtotime('interview_date'));
 // echo  $iterdate= date("F j, Y, g:i a", $interview_date);
  //echo "hii".$interview_date;
  
	?>