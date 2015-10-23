﻿<?php
/**
 * Buscador de video adaptado a requerimientos de tu pagina web
 * Dessarrollado:
 * -primera parte 'NO ORIENTADO A OBJETOS'
 * index.php = utliza recursos.php
 * 	Aqui recorremos con un For Para ver los resultados
 * 
 * Es bastante modificable esta plantilla
 *  
 * -segunda parte 'POO'
 * bueno siempres se recomienda pero como dicen muchos, y lo
 * eh comprobado utiliza un poco mas de recuros pero el resutado
 * vale la pena el trabajo sale mas ordenado y facil de manipular.
 * 
 * @author anbCopitan
 * @copyright aporte youtube
 * @link 
 */?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html<?php	include 'recursos/functions.php'; ?>>
<head>

<meta name="description" content="Buscar gratis millones de videos en toda la red de youtube. Tierno amor portal de videos digitales mas grande la red." />
     <meta name="keywords" content="imagenes, videos, fondos, wallpapers, bajar videos, descargar videos, youtube" />

     <meta http-equiv="content-language" content="ES" />
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Videos - <?php echo $titulo; ?></title>
<link rel="icon" href="http://www.tiernoamor.com/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="http://www.tiernoamor.com/favicon.ico" type="image/x-icon">
<!-- CSS --><link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo $HOST; ?>css/style.css" />
<!-- JS
<script type="text/javascript" src="<?php echo $HOST; ?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $HOST; ?>js/DD_roundies.js"></script>
<script type="text/javascript" src="<?php echo $HOST; ?>js/funciones.js"></script>
 -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-5028317-2']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>
<div id="pagina">

<div id="header"></div> 

<div id="buscador">
  <form name="b_vi" action="index.php" method="get">
    <input id="q"	type="text" name="q" size="30" value="<?php echo $_GET['q'];?>" class="input">
    <input  type="submit" id="send"  value="Buscar Videos">
  </form>
</div>
<div class="linea"></div>
<!--- ISQUIERDA -->



<div id="contenedor">
<div id="modulo">

<?php
	if($num > 1) {		
		echo '<div id="medio">';			
		echo '<h2>Videos encontrados...</h2>';				
		echo '</div>';
		
//INICIO EL FOR
		for($i=0; $i<=$cant; $i++) { if($vid[$i]['id']!="") {?>
        
<div class="images">            
<div class="img">
<a	href="<?php echo $vid[$i]['pag_video']; ?>" > <img src=' <?php echo $vid[$i]['img']; ?> 'alt=' <?php echo $vid[$i]['titulo']; ?> '></a>
</div><!-- FIN img-->

<p> <?php echo '<a title="'.$vid[$i]['titulo'].'" href="'.$vid[$i]['pag_video'].'">'.$vid[$i]['titulo'].'</a>'; ?></p>
<!--link-->			
<span>duracion: <?php echo $vid[$i]['duracion']; ?>min  | visto <?php echo $vid[$i]['contador_view'];?> veces</span>

</div><!-- Fin class imgages  --> <?php } }
		
	}else{			

		//mostrat CONTENDIDO ANTES DE BUSCAR
} ?>





<!-- Fin Condicion Principal -->
</div>
<!-- fin de Modulo -->

<div class="both"></div>





<?php if($num>1) {?>
<div id="paginador"><?php
	if ($page==2)
		echo '<span><a href="?q='.$q.'"><< Anterior</a></span>';
	elseif($page!=1 /*||$page != 0*/)
		echo '<span><a href="?q='.$q.'&p='.($page-1).'"><< Anterior </a></span>';
				
	echo '<span><a href="?q='.$q.'&p='.($page+1).'"> Siguiente >></a></span>';?>
</div>

<div class="both"></div>
<?php }?>


<div class="both"></div>

</div><!-- fin contenedor -->

<!-- pie de pagina-->
<div id="pie"> <a href="<?php echo $HOST; ?>"><?php echo $titulo; ?></a> <A href="http://whos.amung.us/stats/rk37gvmh/" target=_blank><IMG border=0 src="http://whos.amung.us/swidget/rk37gvmh.png" width=0 height=0></A></div>

</div>
</body>
</html>