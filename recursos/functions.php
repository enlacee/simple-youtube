<?php 
//aki donde tienes que arreglar para tu HOST
$configuracion = parse_ini_file("config/config.ini",TRUE);
//variables
$HOST 	= $configuracion[pagina][host];
$titulo	= $configuracion[pagina][titulo]; //$TITULO	= "TiernoAmor.com";
$autor  = $configuracion[autor][nombre];


//$HOST	= "http://".$_SERVER['HTTP_HOST'].'/video/';	//."/".@$_SERVER['REQUEST_URI']; //RUTA especifica
//$HOST	= "http://".$_SERVER['HTTP_HOST'].'/video/';
//$HOST2 	= "http://".$_SERVER['HTTP_HOST'].''.$_SERVER['REQUEST_URI'];
$HOST2  = $configuracion[pagina][host].''.$_SERVER['REQUEST_URI'];;
$HOST3 = $_SERVER['REQUEST_URI'];


//HAy otro $host en VideosRelacionados.php buscalo Y edita SI es necesario

$cant	= 20;
$CURL	= 1;
//------------------Variables --------------------//
$q		= $_GET['q'];
$q		= str_replace(" ","+",$q);
$page 	= $_GET['p'];

if(empty($page)){
	$page=1;
	$npag=1;
}else{
	$npag=$cant*$page;
}
//---------------------------------
//				FUNCIONES
//---------------------------------
	
function leer_feed($q){		
		global $npag;
		global $cant;
		$url_api="http://gdata.youtube.com/feeds/api/videos?q=".$q."&start-index=".$npag."&max-results=".$cant."&client=ytapi-youtube-search&v=2";
		//$url_api="http://gdata.youtube.com/feeds/api/videos?q=".$q."&start-index=".$npag."&max-results=".$cant."&v=2";
		
		print $url_api;
		$sxml = simplexml_load_file($url_api);
		$contador=0;
		
		

		foreach ($sxml->entry as $entry) {
		global $i;
				$i++;
					

		$media = $entry->children('http://search.yahoo.com/mrss/');
		
		
		
		$attrs = $media->group->player->attributes();		
		
		$url[$i]  		= $attrs['url'];	
		$titulo[$i]		= $media->group->title; $titulo[$i]=substr(ucwords($titulo[$i]),0,50);
		$descripcion[$i]= $media->group->description;
		$etiqueta[$i]	= $media->group->keywords;
		((empty($etiqueta[$i])? $etiqueta[$i]="Music": $etiqueta[$i]=$etiqueta[$i]));
		
		// get thumbnail
		$attrs = $media->group->thumbnail[0]->attributes();
		$img[$i]		= $attrs['url'];
		
		// get <yt:duration> node for video length
		$yt = $media->children('http://gdata.youtube.com/schemas/2007');
		$attrs = $yt->duration->attributes();
		
		$length[$i] = $attrs['seconds'];//*****OK				

		$yt = $entry->children('http://gdata.youtube.com/schemas/2007');
		$attrs = $yt->statistics->attributes();	
		@$viewCount[$i]=$attrs['viewCount'];		// buscar "google vs bing" ERROR  ERROR ERROR ERROR PASADO POR ALTO PROVAR 
		
		
		
		
		
		$gd = $entry->children('http://schemas.google.com/g/2005'); 
		if ($gd->rating) {
			$attrs = $gd->rating->attributes();
			$rating[$i] = $attrs['average'];
		} else {
			$rating[$i] = 0;
		}
		
		
		$url_amigable = (urls_amigables($titulo[$i]));
		
		// Creando Array almacen de DATOS		
		$vid[$i]=array(
				 'titulo'		=> (strtolower($titulo[$i])),
				 'id'			=> getIde($url[$i]),
				 'img'			=> 'http://img.youtube.com/vi/'.getIde($url[$i]).'/hqdefault.jpg',
				 'duracion'		=> minutes($length[$i]),
				 'pag_video' 	=> ''.getIde($url[$i]).'-'.$url_amigable.'.html',
				 'url_amigable' => $url_amigable,
				 'pag_tag'		=> 'video.php?tag=',
				 'descripcion'	=> $descripcion[$i],
				 'contador_view'=> $viewCount[$i],
				 'etiqueta'		=> (strtolower($etiqueta[$i])) );		
		
		}//FIN foreach
		return $vid;	
	}

	//CONDICION QUE MOSTRARA datos
//	try {	
	
	if($q){
		$vid = leer_feed($q);
		
		$num = count($vid, COUNT_RECURSIVE);		
		
		for($i=0;$i<=$cant;$i++) {
			$video[$i]=array(
				 'titulo'		=> $vid[$i]['titulo'],
				 'id'			=> $vid[$i]['id'],
				 'img'			=> $vid[$i]['img'],
				// 'duracion'		=> $vid[$i]['duracion'],
				 //'pag_video' 	=> $vid[$i]['pag_video'],				
				// 'pag_tag'		=> $vid[$i]['pag_tag'],
				 'descripcion'	=> $vid[$i]['descripcion'],
				 'contador_view'=> $vid[$i]['contador_view'],
				 'etiqueta'		=> $vid[$i]['etiqueta']);	
	}
		
	}//FIN de IF	
	
//	} catch (Exception $e) {
//		echo "ERROR EN TRY =$e";
//	}
	
//---------------------------------------------------------

	function getDigitos($cadena){
		$pattern = '/\D+/';
		return preg_replace($pattern, "",$cadena);
	}	
	function getIde($cadena){			
		return substr($cadena,31,11);
	}
	function minutes($secs){
		if ($secs<0) return false;
		    
		$m = (int)($secs / 60); 
		$s = $secs % 60;
		$h = (int)($m / 60); 
		$m = $m % 60;
		    
		$text = "";
		if ($h > 0)
			$text = $h.":";
		        
		if (strlen($s)==1)
		   	$s = "0".$s;
		return $text.$m.":".$s;
		}
		
		
		//URL AMIGABLE
	function urls_amigables($url) {
	
	//Rememplazamos caracteres especiales latinos
	$find = array('á', 'é', 'í', 'ó', 'ú', 'ñ','Ñ');
	$repl = array('a', 'e', 'i', 'o', 'u', 'n','N');
	
	$url = str_replace ($find, $repl, $url);
	
	// Tranformamos todo a minusculas
	$url = strtolower($url);	

	// Añaadimos los guiones
	$find = array(' ', '&', '\r\n', '\n', '+');
	$url = str_replace ($find, '-', $url);	

	// Eliminamos y Reemplazamos demás caracteres especiales

	$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
	$repl = array('', '-', '');
	$url = preg_replace ($find, $repl, $url);

	return $url;	
}	
	
?>



