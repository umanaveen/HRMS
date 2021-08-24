<?php
require '../../../../connect.php';
require '../../../../user.php';
require 'PHPMailer/PHPMailerAutoload.php';
require 'class/class.phpmailer.php';
include ('pdf.php');
echo $id=$_REQUEST['id'];

//$count = sizeof($id);
?>
<?php 
class fetch_data{
	function fetch_scope_data($con,$id){ 
	
  	
	$stmt= $con->query("select * from project a LEFT JOIN client_master b on a.client=b.id  where a.id='$id'"); 
    //echo "select * from project a LEFT JOIN client_master b on a.client=b.id where a.id='$id'";	
	$stmt->execute(); 
	$row        = $stmt->fetch();	
	$client_name      = $row['client_name'];
    $project_name     = $row['project_name'];
    $scope_of_project     = $row['scope_of_project'];
    
    $output ='<table width="100%"  style="margin-top:15px;border: 1px solid !important;"  class="table table-striped">
				 <tr>               
                   <th nowrap="nowrap" >SCOPE OF WORK</th>
				 </tr>
				 <tr> 
                  <td nowrap="nowrap">'.$scope_of_project.'</td>
                 </tr>
				  </table>';
				  return $output;
	 }
				  
	}	


   $stmt= $con->query("select a.id as project_id,b.client_name,a.project_name,a.scope_of_project
     from project a LEFT JOIN client_master b on a.client=b.id  where a.id='$id'"); 
	 
	 
   // echo "select a.id as project_id,b.client_name,a.project_name,a.scope_of_project
    // from project a LEFT JOIN client_master b on a.client=b.id  where a.id='$id'";	
	$stmt->execute(); 
	$row     = $stmt->fetch();	
	$id      = $row['project_id'];
    $client_name      = $row['client_name'];
    $project_name     = $row['project_name'];
    $scope_of_project = $row['scope_of_project'];
	
    $class_quote = new fetch_data();
	$class_quote->fetch_scope_data($con,$id);  
	$file_name = md5(rand()) . '.pdf';
	$html_code = '<link rel="stylesheet" href="bootstrap.min.css">';
	$html_code .=  $class_quote->fetch_scope_data($con,$id);
	//$grabzIt->SaveTo("images/result.jpg");
	$pdf = new Pdf();
	$pdf->setPaper('A4', 'portrait');
	$pdf->load_html($html_code);
	$pdf->render();
	$file = $pdf->output();
	
	file_put_contents($file_name, $file);
	$mail = new PHPMailer;	
	$mail->SMTPDebug = 3; 
	$mail->IsSMTP(true);								//Sets Mailer to send message using SMTP
	$mail->Host = 'smtp.zoho.com';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
	$mail->Port = '465';								//Sets the default SMTP server port
	$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
	$mail->Username = 'umadevi.v@bluebase.in';					//Sets SMTP username
	$mail->Password = 'naveen@uma';					//Sets SMTP password
	$mail->SMTPSecure = 'ssl';							//Sets connection prefix. Options are "", "ssl" or "tls"
	$mail->From = 'umadevi.v@bluebase.in';			//Sets the From email address for the message
	$mail->FromName = 'Bluebase';			//Sets the From name of the message
	$mail->AddAddress('antoajithkkrk@gmail.com', $client_name);		//Adds a "To" address
    $mail->AddAttachment($file_name); 
	$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
	$mail->IsHTML(true);							//Sets message type to HTML				
	 				//Adds an attachment from a path on the filesystem
	$mail->Subject = 'Project Work Scope';			//Sets the Subject of the message
					//An HTML or plain text message body
	
	$mail->Body = "Dear \r\n".$client_name."\r\n Kindly refer the following data"." ,"."\r\n\r\n<br/><br/><br/><br/>";	
	$mail->Body    .= "CLIENT NAME : ".$client_name."\r\n\r\n<br/>"; 
	$mail->Body   .= "PROJECT NAME: ".$project_name."\r\n\r\n<br/>";
	//$mail->Body   .= "SCOPE OF PROJECT : ".$scope_of_project."\r\n\r\n<br/>";
   //$mail->Boby .= $message;
	/* $mail->Body    .= "<br/>".
	 "<table width='100%' border='1' style='margin-top:15px;' align='left class='table table-striped'>". 
                  "<thead><tr>".                 
                  "<th nowrap='nowrap'>SCOPE OF WORK</th>".
                 "<tr nowrap='nowrap'>$scope_of_project</tr>".  
			  
				   "</tbody></table>"; */
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