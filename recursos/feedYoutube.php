<?php

$categoria		= $_REQUEST['categoria'];
$categoria = "music";

function leerFeedCategoria($categoria){		
		global $npag;
		global $cant; //http://gdata.youtube.com/feeds/api/videos/-/music
		//http://gdata.youtube.com/feeds/api/standardfeeds/top_favorites
		//$url_api="http://gdata.youtube.com/feeds/api/standardfeeds/top_favorites?time=today";
		//$url_api="http://gdata.youtube.com/feeds/api/videos/-/".$categoria;
		//$url_api='http://gdata.youtube.com/feeds/base/standardfeeds/ES/most_viewed?client=ytapi-youtube-browse&alt=rss&time=today';
		$url_api="http://gdata.youtube.com/feeds/api/videos/-/music?time=today";
		
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
		
		//usa include functions.php
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
	
	
	if($categoria){
	$vid = leerFeedCategoria($categoria);	
		$html='';
	
		for( $i=1; $i<=count($vid); $i++ ) {						
			$html .= '<li>';
			$html .= '<div class="img">';			
			$html .= '<a href="'.$vid[$i]['pag_video'].'">';
			$html .= '<img  src="'.$vid[$i]['img'].'"/></a>';			
			$html .= '</div>';	
			$html .= '<div class="titulo">'.$vid[$i]['titulo'].'</div>';		
			$html .= '</li>';			
		}
	$rpta_html=$html;
		
	}
	
	
	
	
	/*-------------------------------------------------------------------*/	
	
	$arreglo = array(
		0	=> array("titulo" => "selena gomez", 	"id" => "M8uPvX2te0I"),
		1	=> array("titulo" => "demi lovato",		"id" => "CwEdKLw-E5w"),
		2	=> array("titulo" => "megan fox",		"id" => "JooN-5yFors"),
		3	=> array("titulo" => "lady gaga",		"id" => "Ht8ZjuFzlUc"),
		4	=> array("titulo" => "eminem",			"id" => "KrLXpiVtAwg"),
		5	=> array("titulo" => "shakira",			"id" => "_3-GiVIE8gc"),
		6	=> array("titulo" => "miley cyrus",		"id" => "LK2fd85pcU0"),
		7	=> array("titulo" => "ashley tisdale",	"id" => "On_ZPiDEqkA"),
		9	=> array("titulo" => "Celine Dion",		"id" => "FJw3YfRDnA4"),
		10	=> array("titulo" => "Kylie Minogue",		"id" => "frv6FOt1BNI"),
		11	=> array("titulo" => "Britney Spears",		"id" => "e7Fb3guhga8")		
	);	shuffle($arreglo);
			

/*	
	$fruits = array (
    "frutas"  => array("a" => "naranja", "b" => "platano", "c" => "manzana"),
    "numeros" => array(1, 2, 3, 4, 5, 6),
    "hoyos"   => array("primero", 5 => "segundo", "tercero")
	);
	print_r($fruits);
*/	

	
	
	
	
	
