<?php 
include("lib/librerias.php");
/*    $nombre = $_REQUEST["nombre"];
    $correo = $_REQUEST["correo"];
    $telefono = $_REQUEST["telefono"];


    $message  ="<b>Nombre y Apellido: </b> ". $nombre."<br>";
    $message .="<b>Correo de Contacto: </b> ". $correo."<br>";
    $message .="<b>Telefono: </b> ". $telefono."<br><br><br>";


    $email = $_REQUEST["email"];
    $message .= str_replace("%","&",$_REQUEST["editor1"]);
    $subject  = $_REQUEST["asunto"];
    $headers  = "MIME-Version: 1.0\r\n"; 
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 	
    $headers .= "From: Contacto en Línea | <$correo>\r\n";
    $headers .= "Reply-To: $correo\r\n"; 
    //mail($email, $subject, $message, $headers);
   

    $resp = mail("sidharlozada@gmail.com", $subject, $message, $headers);

    if ($resp==TRUE) {
        $resp = 1;
    }else{
        $resp = 2;
    }
    
        $json=new Services_JSON();
        echo $json->encode($resp);
*/


include ("PHPMailer/src/PHPMailer.php");

// Get username and password from environment variables
$username = "contactoweb@alcaldialibertador-carabobo.gob.ve";
$password = "C0nt4ct0W3b";

// Relay SMTP service configuration
$host = 'mail.alcaldialibertador-carabobo.gob.ve';
$port = 465;//465 587


// Custom data
$fromEmail = $correo;
$fromName = $nombre;
$to1Email = 'recipient1@example.com';
$to1Name = 'Recipient1 Name';
$to2Email = 'recipient2@example2.com';
$to2Name = 'Recipient2 Name';
$subject = $_REQUEST["asunto"];
$text = "Doppler Relay speaks plaintext";



// Send message using PHP Mailer
$mail = new PHPMailer;
die("paso 2");

$mail->IsSMTP();
die("paso 3");

$mail->Host = $host;
$mail->Port = $port;
$mail->SMTPAuth = true;
$mail->AuthType ='LOGIN';
$mail->Username = $username;
$mail->Password = $password;
$mail->From = $fromEmail;
$mail->FromName = $fromName;
/*$mail->AddAddress($to1Email, $to1Name);
$mail->AddAddress($to2Email, $to2Name);*/
$mail->IsHTML(true);
$mail->Subject = $subject;
$mail->Body = $message;
$mail->AltBody = $text;

die("paso 4");


if(!$mail->Send()) {
   $resp = 1;
}else{
    $resp = 2;
}
    die("paso 5");

        $json=new Services_JSON();
        echo $json->encode($resp);


?>