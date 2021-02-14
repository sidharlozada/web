<?php
// PHP Mailer previously installed
// See https://github.com/DopplerRelay/docker-php/blob/master/Dockerfile
include_once "/usr/lib/vendor/phpmailer/phpmailer/PHPMailer.php";

// Get username and password from environment variables
$username = "contactoweb@alcaldialibertador-carabobo.gob.ve";
$password = "C0nt4ct0W3b";

// Relay SMTP service configuration
$host = 'mail.alcaldialibertador-carabobo.gob.ve';
$port = 587;//465

// Custom data
$fromEmail = 'you@yourdomain.com';
$fromName = 'Your Name';
$to1Email = 'recipient1@example.com';
$to1Name = 'Recipient1 Name';
$to2Email = 'recipient2@example2.com';
$to2Name = 'Recipient2 Name';
$subject = 'Hello from Doppler Relay, PHP Mailer!';
$text = "Doppler Relay speaks plaintext";
$html = "Doppler Relay speaks HTML";

// Send message using PHP Mailer
$mail = new PHPMailer;
$mail->IsSMTP();
$mail->Host = $host;
$mail->Port = $port;
$mail->SMTPAuth = true;
$mail->AuthType ='LOGIN';
$mail->Username = $username;
$mail->Password = $password;
$mail->From = $fromEmail;
$mail->FromName = $fromName;
$mail->AddAddress($to1Email, $to1Name);
$mail->AddAddress($to2Email, $to2Name);
$mail->IsHTML(true);
$mail->Subject = $subject;
$mail->Body = $html;
$mail->AltBody = $text;

if(!$mail->Send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}
echo 'Message has been sent';

?>