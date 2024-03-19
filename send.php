​<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\php\StudentVoiceHub-main\PHPMailer-master\src\PHPMailer.php';
require 'C:\xampp\htdocs\php\StudentVoiceHub-main\PHPMailer-master\src\Exception.php';
require 'C:\xampp\htdocs\php\StudentVoiceHub-main\PHPMailer-master\src\SMTP.php';

function send_mail($emfrom, $nmfrom, $emto, $nmto, $subj,$htmlbody) {

$mail = new PHPMailer;
$mail->isSMTP(); 
//$mail->SMTPDebug = 2; 
$mail->Host = "smtp.gmail.com"; 
$mail->Port = "587"; 
$mail->SMTPSecure = 'tls'; 
$mail->SMTPAuth = true;
$mail->Username = "student.voice.hub.999@gmail.com";
$mail->Password = "oduzceotkmbqtmqj";
$mail->setFrom($emfrom, $nmfrom);
$mail->addAddress($emto, $nmto);
$mail->Subject = $subj;
$mail->msgHTML($htmlbody); 
// $mail->send();
if($mail->send()) {
return "Message has been sent successfully";
} else {
return "Mailer Error: " . $mail->ErrorInfo;
}
}

?>​
