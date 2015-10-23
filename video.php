<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html<?php	include 'recursos/functions.php'; ?>>
<?php
	include 'recursos/CrearReproductor.php';	
	include 'recursos/VideosRelacionados.php';
?>
<head>

<meta name="description" content="<?php echo $video[1]['descripcion'];?>" />
        <meta name="keywords" content="<?php echo $video[1]['etiqueta']?>" />

        <meta http-equiv="content-language" content="ES" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?php echo $video[1]['titulo'];?> | <?php echo $TITULO;?></title>
<!-- Titulo de la pagina-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="icon" href="http://www.tiernoamor.com/favicon.ico"
	type="image/x-icon">
<link rel="shortcut icon"
	href="http://www.tiernoamor.com/favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="<?php echo $HOST ; ?>css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style.css">

<script type="text/javascript" src="<?php echo $HOST ; ?>js/mt.js"></script>
<script type="text/javascript" src="<?php echo $HOST ; ?>js/import-popup.js"></script>
<script type="text/javascript" src="<?php echo $HOST ; ?>js/funciones.js"></script>
<script type="text/javascript" src="<?php echo $HOST ; ?>js/mt-funciones.js"></script>


</head>
<body>
<div id="pagina">

<div id="header">
    <a href="javascript:void(0);" onClick="verEm()">ver </a>
</div> 

<div id="buscador">

 <form name="b_vi" action="<?php echo $HOST; ?>index.php" method="get">
   <input id="q"	type="text" name="q" size="30" value="<?php echo $_GET['q'];?>" class="input">
   <input id="send" type="submit"  value="Buscar videos">
</form>
 
</div>







<div class="linea"></div>
<!--- ISQUIERDA -->

<div id="contenedor">
<!--inicio poup-->
<div id="divENVXMAIL" style="display:display;">

<div id ="popup-cabecera" class="popup-cabecera">
<div id="popup-cerrar" class="popup-cerrar" onClick="cerrarEm()"></div>

<span class="popup-lbl">Enviar video por email:</span></div>

<div id="popup-cuerpo">

<div id="form-enviar-mail">

<form method="post" action="enviar-mail.php">
  <p><span class="negrita">de:</span>
      <span class="texto">nombre</span><input type="text" name="emisor_name" size="20" id="emisor_name" />
      <span class="texto">mail</span><input type="text" name="emisor_mail" size="30" id="emisor_mail" />
  </p>
  <p><span class="negrita">para:</span><span class="texto">nombre</span>
    <input type="text" name="receptor_name" size="20" id="receptor_name" />
    <span class="texto">mail</span><input type="text" name="receptor_mail" size="30" id="receptor_mail" />
  </p>
  <p><span class="negrita">Tu mensaje</span></p>     
    <textarea name="emisor_mensaje" rows="5" cols="29" id="emisor_mensaje"></textarea>
  
  <p>
    <input name="id" type="text" id="id" value="<?php echo $HOST2; ?>">
    <input name="video_id" type="text" id="video_id" value="<?php echo $videoID; ?>">
  </p>
  <p>
    <input id="enviar2" type="button" value="Enviar" onClick="enviarMail()"/>
    
<!-- inicio divEnv-->
  <br />
  <br />
          </p>


</form>
<div id ="rpta_enviar"></div>

</div>


</div>
<div id="rpta_ajax"></div>

</div>
<!--fin popup-->



<!-- Inicio Reproductor -->
<?php
if(empty($_REQUEST['p'])){

	$html = '';
	
	$html .= '<h1>'.$video[1]['titulo'].'</h1>';

	$html .= '<div id="reproductor">';
	$html .= '<span id ="google_ads_frame1">
<script type="text/javascript"><!--
google_ad_client = "pub-9694619181645086";
/* 336x280, creado 23/03/08 */
google_ad_slot = "6324192189";
google_ad_width = 336;
google_ad_height = 280;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</span>';
	$html .= '<div id ="r-video">';//inicio
//	$html .= '<iframe class="youtube-player" type="text/html" width="629" height="353" src="http://www.youtube.com/embed/'.$video[1]['id'].'" frameborder="0"></iframe><br>';
	
	$html .= '<object width="629" height="353" id="ytplayer" data="http://www.youtube.com/v/'.$video[1]['id'].'?enablejsapi=1&autoplay=1&amp;version=3" type="application/x-shockwave-flash" allowfullscreen="true" >';
	$html .= '<param value="always" name="allowscriptaccess">';
    $html .= '<param value="http://www.youtube.com/v/'.$video[1]['id'].'?enablejsapi=1&autoplay=1&amp;version=3" name="movie">';
    $html .= '</object>';	

	
	$html .= '<div id="descripcion">';
	$html .= '<p><b>'.$video[1]['titulo'].'</b></p>';
	$html .= $video[1]['descripcion'];
	$html .= '</div>';//fin div descripcion
	

	
	$urlx= $HOST.'formulario.php?url='.$HOST2;
	

	
	
	
	
	
	
	$html .= '<p><a href="'.$HOST.'formulario.php?url='.$HOST2.'">dedicarSSSSSSvideo</a></p>';
	
	$html .= '<a title="'.$video[1]['titulo'].'" href ="http://www.youtube-mp3.org/get?video_id='.$video[1]['id'].'" target="_blank">descargar este video en MP3 (audio)</a>';
	$html .= '<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style">
<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
<a class="addthis_button_tweet"></a>
<a href="http://www.addthis.com/bookmark.php?v=250&amp;username=xa-4c8bc3bb4814616e" class="addthis_button_compact">Compartir</a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4c8bc3bb4814616e"></script>
<!-- AddThis Button END -->';
	$html .= '</div>';

	$html .= '</div>';
	
	
	


	
	
	echo $html;

}
?>

<?php 
/*
	$etiqueta = $video[1]['etiqueta'];
	$nun = count($etiqueta);
	
	for($x=0; $x<$nun; $x++){		
		$etiq = explode(",", $etiqueta);	
		
		$conteo =count($etiq);		
		if($conteo==0 ||$conteo==1||($conteo==NULL)|| ($conteo==null))
		echo '<a title="Music" href="'.$video['pag_tag'].'music">Music</a> ';	
			
		if($conteo>6) $conteo=5;
		
		for($c=0; $c<$conteo; $c++){
			$trimed = trim($etiq[$c]);
			echo '<a title="'.$trimed.'" href="'.$video['pag_tag'].$trimed.'">'.$trimed.'</a> ';}	 //** LINK TAG
	}
*/
?>
<!-- Formulario estuvo AQUI -->





<!-- Fin Reproductor -->
	
	<div class="both"></div>	
	
	<?php
	if(!empty($_REQUEST['v'])){		
		echo '<div id="medio"><h2>Videos relacionadosss</h2></div>';	
		
		$id		= $_REQUEST['v'];
		$titulo = $_REQUEST['titulo'];
		$pagina = $_REQUEST['pag'];
		
		// controlando PASar ID
		$id 	= substr($id,0,11);		
		//echo '<h1>id='.$id.'</h1>';
		
		new VideosRelacionados($id,$pagina);
		
		}

	?>
	


<div class="both"></div>
</div><!-- fin Contenedor -->
<!-- pie de pagina-->
<div class="both"></div>

<div id="pie">
	<a href="<?php echo $HOST; ?>"><?php echo $Titulo; ?></a>
	<a href="http://whos.amung.us/stats/rk37gvmh/" target=_blank><IMG border=0 src="http://whos.amung.us/swidget/rk37gvmh.png" width=0 height=0></a>
</div>

</div>
<!-- </div>  -->
<div class="modulo" style="display:none;">
<h1 onClick="peticion()">buscador de video prueba</h1>

<div id="youtube">
aki se muestra los resultados:,,, <h2 onClick="valoresFormulario()" >prubaaaaaaaaa</h2>
</div>



</div> 
</body>
</html>

