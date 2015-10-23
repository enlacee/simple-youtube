
<?php

 $videoID = $_REQUEST['v'];  $videoID =(substr($videoID,0,11));
 $pag_estado = $_GET['p'];
 
 $video = imprimir($videoID,$pag_estado);
 //$video; //ARRAy datos almacen
 /**********************************************************************/
	$titulo=substr(ucwords($video[1]['titulo']),0,50);
 	$url_1  = $video[1]['id'];
 	$url_2  = urls_amigables($titulo); 	
 	$id = $url_1.'-'.$url_2;
 /*********************************************************************/	
	//------------
	
	function imprimir($videoID,$pag_estado){	//http://gdata.youtube.com/feeds/api/videos?vq=I27WefdSgI4

		if(!empty($pag_estado))
			return false;		
		else {
		
		$feedURL = 'http://gdata.youtube.com/feeds/api/videos?vq='.$videoID;
		$sxml = simplexml_load_file($feedURL);
		
		$i=0;
		//--------
		foreach ($sxml->entry as $entry) {			
			global $i;
				$i++;
				
		$media = $entry->children('http://search.yahoo.com/mrss/');  
		
		$attrs		= $media->group->player->attributes();		
		$url_t	  	= $attrs['url'];	
		$titulo		= $media->group->title;
		$descripcion= $media->group->description;
		$etiqueta	= $media->group->keywords;
		
		// get <yt:duration> node for video length
		$yt = $media->children('http://gdata.youtube.com/schemas/2007');
		$attrs = $yt->duration->attributes();
		$seg = $attrs['seconds'];//*****OK		
	
		
	/**********************************************/
		
	/*******************************************/
		if($i<=1){			//($i<=1)
		$video[$i] =array('titulo'		=> $titulo,
					'url'			=> $url_t,
					'id'			=> getIde($url_t),
					'img'			=> "http://img.youtube.com/vi/".getIde($url_t)."/default.jpg",
					'pag_video' 	=> 'video.php?v='.getIde($url_t),
					
					'pag_etiqueta'	=> 'video.php?tag=',
					'duracion'		=> minutes($seg),
					'etiqueta'		=> $etiqueta,
					'descripcion'	=> descripcion_c($descripcion));
		}
		
		}//fin de for		
		return $video;
		
		}
		
		
	}//fin de IMPRIMIR
	
	
		function tituloCorto($tit){				
			return substr($tit,0,40);
		}		

		function descripcion_c($texto){
			return substr($texto,0,400);	
		}
		
		
		


?>		