<?php

 $videoID = !empty($_REQUEST['v']) ? substr($_REQUEST['v'],0,11) : '';
 $pag_estado = !empty($_GET['p']) ? $_GET['p'] : '';
 
 $data_video = imprimir($videoID, $pag_estado, $YOUR_API_KEY);
 $video = $data_video[0];
 //$video; //ARRAy datos almacen
 /**********************************************************************/
	$videoTitulo = substr(ucwords($video['titulo']),0,50);
 	$url_1 = $video['id'];
 	$url_2 = urls_amigables($videoTitulo); 	
 	$id = $url_1.'-'.$url_2;
 /*********************************************************************/	
	//------------
	
/**
* https://www.googleapis.com/youtube/v3/videos?id='+id_youtube+'&key='+YOUR_API_KEY+'&part=snippet,contentDetails,statistics,status
*/
function imprimir($videoID,$pag_estado, $YOUR_API_KEY){
	$video = false; 

	if (!empty($pag_estado)) {
		$video = false;		
	} else {

		$url_api = 'https://www.googleapis.com/youtube/v3/videos'
		. '?id=' . $videoID
		. '&part=snippet,contentDetails,statistics,status'
		. '&key=' . $YOUR_API_KEY;

		//echo $url_api;exit;

		$string = file_get_contents($url_api);
		$json = json_decode($string, true);
		$video = array();

		if (!is_null($json) && is_array($json) && isset($json['pageInfo'])) {
			foreach ($json['items'] as $key => $value) {
				$data_id = $json['items'][$key]['id'];
				$data_O1 = $value['snippet'];

				$video[] = array(
					'titulo' => $data_O1['title'],
					'url' => 'https://www.youtube.com/watch?v=' . $data_id,
					'id' => $data_id,
					'img' => $data_O1['thumbnails']['medium']['url'],
					'pag_video' => 'video.php?v='. $data_id,
					'pag_etiqueta' => 'video.php?tag=',
					'duracion' => '123', //minutes($seg),
					'etiqueta' => 'etiqueta',
					'descripcion' => descripcion_c($data_O1['description'])
				);
			}
		}
			
	}
		
	return $video;
}//fin de IMPRIMIR
	
	
	function tituloCorto($tit){				
		return substr($tit,0,40);
	}		

	function descripcion_c($texto){
		return substr($texto,0,400);	
	}