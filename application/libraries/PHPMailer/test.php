<?php
include_once("PHPMailerAutoload.php");
$mail                = new PHPMailer();
$mail->IsSMTP(); 
$mail->SMTPDebug  = false; 
$mail->SMTPAuth   = true;     
$mail->Host       = 'mx1.hostinger.co.id'; // SMTP host
$mail->Port       = 2525; // SMTP open port
$mail->Username   = 'info@distro-it.com'; // SMTP username
$mail->Password   = 'Test13245';
$mail->SetFrom('info@distro-it.com', ' Info Dis DIsk'); 
$mail->AddReplyTo('info@distro-it.com','Info Dis DIsk Relply'); 
$email = "presidendepok@gmail.com"; // Recipient email
$mail->AddAddress($email);
$mail->Subject    = 'Test Emaulll'; // Email subject

$mail->AltBody    = 'To view the message, please use an HTML compatible email viewer!'; 
$mail->IsHTML(false);
$mail->Body = 'Hack the planet r0x!';


if(!$mail->Send()) {
  echo "Mailer Error: ". $mail->ErrorInfo;
} else {
  echo "Message sent!";
}    
// From : www.Kriptonium.com   
?>