<?php
	include 'recursos/functions.php';
	include 'recursos/CrearReproductor.php';
	include 'recursos/VideosRelacionados.php';
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="<?php echo $video['descripcion'];?>" />
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title><?php echo $video['titulo'];?> | <?php echo $titulo; ?></title>
</head>
<body>
<div id="pagina">

	<div id="header"></div>
	<div id="buscador">

		<form name="b_vi" action="<?php echo $HOST; ?>index.php" method="get">
			<input id="q"	type="text" name="q" size="30" value="<?php echo !empty($_GET['q']) ? $_GET['q'] : ''; ?>" class="input">
			<input id="send" type="submit"  value="Search videos">
		</form>
	</div>

	<div class="linea"></div>

	<div id="contenedor">
		<?php
		if (empty($_REQUEST['p'])) {

			$html = '';
			$html .= '<h1>'.$video['titulo'].'</h1>';
			$html .= '<div id="reproductor">';
			$html .= '<object width="629" height="353" id="ytplayer" data="http://www.youtube.com/v/'.$video['id'].'?enablejsapi=1&autoplay=1&amp;version=3" type="application/x-shockwave-flash" allowfullscreen="true" >';
			$html .= '<param value="always" name="allowscriptaccess">';
		    $html .= '<param value="http://www.youtube.com/v/'.$video['id'].'?enablejsapi=1&autoplay=1&amp;version=3" name="movie">';
		    $html .= '</object>';

			$html .= '<div id="descripcion">';
			$html .= '<p><b>'.$video['titulo'].'</b></p>';
			$html .= $video['descripcion'];
			$html .= '</div>';//fin div descripcion
			$html .= '</div>';


			$html .= '
		<div class="addthis_toolbox addthis_default_style">
		<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
		<a class="addthis_button_tweet"></a>
		<a href="http://www.addthis.com/bookmark.php?v=250&amp;username=xa-4c8bc3bb4814616e" class="addthis_button_compact">Compartir</a>
		</div>';
			echo $html;
		}
		?>
		<div class="both"></div>
		<?php
		if (!empty($_REQUEST['v'])) {
			echo '<div id="medio"><h2>Videos related</h2></div>';
			$id		= !empty($_REQUEST['v']) ? $_REQUEST['v'] : '';
			$titulo = !empty($_REQUEST['titulo']) ? $_REQUEST['titulo'] : '';
			$pagina = !empty($_REQUEST['pag']) ? $_REQUEST['pag'] : 1;
			$id = substr($id,0,11);
			new VideosRelacionados($id, $pagina);
		} ?>

		<div class="both"></div>
	</div><!-- fin Contenedor -->

	<div class="both"></div>
	<div id="pie">
		<a href="<?php echo $HOST; ?>"><?php echo $titulo; ?></a>
	</div>
</body>
</html>
