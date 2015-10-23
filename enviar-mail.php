<?php 	include 'phpmailer/class.phpmailer.php'; ?>

<?php

//Datos enviados por Ajax
$ip		= $_SERVER['REMOTE_ADDR'];
$emisor_name	= $_POST['emisor_name'];
$emisor_mail	= $_POST['emisor_mail'];
$emisor_mensaje	= $_POST['emisor_mensaje'];
$url_id			= $_POST['id'];
$video_id		= $_POST['video_id'];

$receptor_name	= $_POST['receptor_name'];
$receptor_mail	= $_POST['receptor_mail'];
//FIN datos



function getThumbnail($video_id){
	$rpta = "<a href=\"$url_id\"><img src=\"http://img.youtube.com/vi/$video_id/hqdefault.jpg\" width=\"300\" height=\"224\" />";
	return $rpta;
}
$images = getThumbnail($video_id);
echo $images;

//$body = file_get_contents('http://vimeo.com/');
$mensaje  ="<b>Mensaje:</b><br/>".getThumbnail($url_id);
$mensaje .= $emisor_mensaje;
$mensaje .= "<br/><b>visita:</b><br/> <a href=\"$url_id\">$url_id</a>";

$mail = new PHPMailer();
$mail->From = $emisor_mail;
$mail->FromName = $emisor_name;
$mail->Subject = $emisor_mail." Te envio una dedicatoria";
$mail->Body = $body.$mensaje;
$mail->IsHTML(true);

//$mail->AddAttachment('images/e.png');
$mail->AddAddress($receptor_mail, $receptor_name);

if($mail->Send())
	echo 'MAIL FUE ENVIADO!';
else
	echo 'ERRORR error enviar o mail'.$mail->ErrorInfo;

?>
