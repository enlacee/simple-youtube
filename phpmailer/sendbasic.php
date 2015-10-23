<?php
require_once("class.phpmailer.php");

$mail = new PHPMailer();
$mail->From = "from@domain.com";
$mail->FromName = "From Name";

$mail->Subject = "Demo de PHPMailer";
$mail->Body = "Hola <strong>Jim</strong>, bienvenido!!!";
$mail->IsHTML(true);

$mail->AddAddress("user@domain.com", "User Name");
$mail->Send();
?>