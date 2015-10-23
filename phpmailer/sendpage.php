<?php
require_once("class.phpmailer.php");

$body = file_get_contents('http://www.google.com/');

$mail = new PHPMailer();
$mail->From = "from@domain.com";
$mail->FromName = "From Name";
$mail->Subject = "Demo de PHPMailer";
$mail->Body = $body;
$mail->IsHTML(true);
$mail->AddAddress("user@domain.com", "User Name");
$mail->Send();
?>