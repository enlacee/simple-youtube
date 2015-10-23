<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html<?php	include 'recursos/functions.php'; ?>>
<?php	include 'recursos/feedYoutube.php'; ?>
<head>

<meta name="description" content="Buscar gratis millones de videos en toda la red de youtube. Tierno amor portal de videos digitales mas grande la red." />
     <meta name="keywords" content="imagenes, videos, fondos, wallpapers, bajar videos, descargar videos, youtube" />

     <meta http-equiv="content-language" content="ES" />
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<link rel="icon" href="http://www.tiernoamor.com/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="http://www.tiernoamor.com/favicon.ico" type="image/x-icon">
	<!-- CSS --><link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $HOST; ?>css/style.css" />
	<title>...</title>
        <script type="text/javascript" src="<?php echo $HOST ; ?>js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo $HOST ; ?>js/jquery.carouFredSel-2.4.1-packed.js"></script>
       
		<script type="text/javascript" language="javascript">
			$(function() {
				$('ul#basic_config').carouFredSel();
				$('ul#user_interaction').carouFredSel({
					auto: false,
					prev: "#prev",
					next: "#next"
				});
			});
		</script>
		
		<style type="text/css" media="all">	
			a, a:link, a:active, a:visited {
				color: blue;
				text-decoration: underline;
			}
			a:hover {
				color: #999;
			}	
			.list_carousel {				
				width:950px;
				margin:5px 0;
				border-top:#CCCCCC solid 1px;
				border-bottom:#CCCCCC solid 1px;
				
			}
			.list_carousel ul {
				margin: 0;
				padding: 0;
				list-style: none;
				display: block;
				
			}
			.list_carousel li {
				/*font-size: 40px;
				color: #666;
				text-align: center;
				background-color: #f0f0f0;*/
				border: 5px solid #EDEFF4;
			/*	height:126px;
				width:168px;	*/			
				display: block;
				float: left;
			}
			
			.clearfix {
				width:950px;
				float: none;
				clear: both;
			}
			#prev {
				margin-left: 10px;
			}
			#next {
				float: right;
				margin-right:10px;
			}
			
			/**---------------------*/
			li img{
				height:126px;
				width:168px;
			}
			.img {
				background:none repeat scroll 0 0 #FFFFFF;
				border:1px solid #C0C0C0;				
			}
			.titulo{
				background-color:#EDEFF4;
				height:30px;
				width:168px;
				text-align:center;
				font:bold 12px/16px Arial ;
				color:#3B5998;
				border:1px solid #EEEEEE;
				padding:5px;
			}
			.images{
				height:200px;
			}
			.pimages img{
				width:160px;
				height:115px;
				
			}


		</style>
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
        
        
			<div id="contenedor">

<!-- ingresando PHP -->
<?php  
/*

	if($categoria){	
	$categoria="music";
	$vid = leerFeedCategoria($categoria);		

	echo '<div class="list_carousel">';
	echo '<ul id="basic_config">';
		
		for( $i=1; $i<=count($vid); $i++ ) {			
			$html  = ''; 			
			$html .= '<li>';
			//$html .= '<div class="img">';
			$html .= '<a href="'.$vid[$i]['pag_video'].'">';
			$html .= '<img  src="'.$vid[$i]['img'].'"/>';
			//$html .= '</div>';
			$html .= '</li>';
			echo $html;			
		}
	echo '</ul>';
	echo '</div>';
	}*/
?>
<p></p>

<!-- ingresando PHP -->
















				<div class="list_carousel" style="display:block;">
                
					<ul id="user_interaction">
					<?php echo $rpta_html; ?>

					</ul>
				</div>
                
				<div class="clearfix">
                <a id="prev" href="#">&lt;</a>
                <a id="next" href="#">&gt;</a>
                </div>
					
              <div class="both"></div>
                
<div id="rigth"></div>
                
 <div id="left" >               
<?php 

for ($i=0; $i< 9/*count($arreglo)*/; $i++){
		$html  ='<div class="images">';
		$html .='<div class="pimages">';
		$html .='<a href="index.php?q='.$arreglo[$i]['titulo'].'">';
		$html .='<img src="http://img.youtube.com/vi/'.$arreglo[$i]['id'].'/hqdefault.jpg" >';
		$html .='</a>';		
		$html .='</div>';
		$html .='<p>'.$arreglo[$i]['titulo'].'</p>';
		$html .='</div>';
		
		echo $html;

	}	

?>
<div class="both"></div>
</div>       
                
                
<div class="both"></div>

<!-- segundo carrucel-->
<div class="list_carousel">
  <ul id="basic_config">
    <?php echo $rpta_html; ?>
  </ul>
  <div class="clearfix"></div>
</div>
</div>

                
                <!-- pie de pagina-->
<div id="pie"> <a href="<?php echo $HOST; ?>"><?php echo $TITULO; ?></a></div>

                
                
                
    </div>
<div class="both"></div>

 carrucel comentado

</body>
</html>