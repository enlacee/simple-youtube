<?php

//aki donde tienes que arreglar para tu HOST
$configuracion = parse_ini_file("config/config.ini",TRUE);
//variables
$HOST 	= $configuracion['pagina']['host'];
$titulo	= $configuracion['pagina']['titulo'];
$autor  = $configuracion['autor']['nombre'];
$YOUR_API_KEY = $configuracion['pagina']['your_api_key'];


//$HOST	= "http://".$_SERVER['HTTP_HOST'].'/video/';	//."/".@$_SERVER['REQUEST_URI']; //RUTA especifica
//$HOST	= "http://".$_SERVER['HTTP_HOST'].'/video/';
//$HOST2 	= "http://".$_SERVER['HTTP_HOST'].''.$_SERVER['REQUEST_URI'];
$HOST2  = $configuracion['pagina']['host'].''.$_SERVER['REQUEST_URI'];;
$HOST3 = $_SERVER['REQUEST_URI'];


//HAy otro $host en VideosRelacionados.php buscalo Y edita SI es necesario

$cant	= 20;
//------------------Variables --------------------//
$q = !empty($_GET['q']) ? $_GET['q'] : '';
$q = str_replace(" ","+",$q);
$page = !empty($_GET['p']) ? (int) ($_GET['p']) : 1;


if ($page == 1) {
	$page = 1;
	$npag = 1;
} else {
	$npag = $cant*$page;
}


//---------------------------------
//				FUNCIONES
//---------------------------------

/**
* example
* https://www.googleapis.com/youtube/v3/search?part=snippet&order=viewCount&type=video&q=selena+gomez&key=AIzaSyAU5Qr9YKw_zA28JheHmcFGyDpd-W7gipw
*
*/
function leer_feed($q, $npag, $cant) {
	$configuracion = parse_ini_file("config/config.ini",TRUE);
	$YOUR_API_KEY = $configuracion['pagina']['your_api_key'];

	$maxResults = $cant; //$cant;
	//$q = 'selena+gomez';
	$stringPageToken = isset($_REQUEST['pageToken']) ? '&pageToken=' . $_REQUEST['pageToken'] : '';
	$url_api = 'https://www.googleapis.com/youtube/v3/search'
		. '?part=snippet'
		. '&maxResults=' . $maxResults
		//. '&order=viewCount'
		. '&type=video'
		//. '&videoEmbeddable=true'
		//. '&topicId=/m/05z1_'
		. '&q=' . $q
		. $stringPageToken
		//. '&prevPageToken=' . $_SESSION['youtube']['prevPageToken']
		. '&key=' . $YOUR_API_KEY;

//print $url_api; //exit;
//ECHO "           ";

	$string = file_get_contents($url_api);
	$json = json_decode($string, true);
	
	$pageTokenNext = '';
	$pageTokenPrev = '';
	$items = array();
	if (!is_null($json) && is_array($json) && isset($json['nextPageToken'])) {
		$pageTokenNext = $json['nextPageToken'];
		$pageTokenPrev = isset($json['prevPageToken']) ? $json['prevPageToken'] : '';

		if (isset($json['items']) && count($json['items']) > 0) {
			foreach ($json['items'] as $key => $value) {
				$data_id = $json['items'][$key]['id']['videoId'];
				$data_O1 = $value['snippet'];

				$url_amigable = urls_amigables($data_O1['title']);
				$items[] = array(
					'titulo' =>  $data_O1['title'],
					'id' => $data_id,
					'img' => $data_O1['thumbnails']['medium']['url'],
					'duracion' => '5:00',
					'pag_video' =>  $data_id . '-' . $url_amigable.'.html',
					'url_amigable' => $url_amigable,
					'pag_tag' => 'video.php?tag=',
					'descripcion' => $data_O1['description'],
					'contador_view' => '123', //$viewCount[$i],
					'etiqueta' => 'etiqueta');
			}//FIN foreach
		}
	}
	
	$return['page_next'] = '?q='. $q;
	if ($npag >= 1) {
		$return['page_next'] .= !empty($pageTokenNext) ? '&pageToken='. $pageTokenNext : '';
	}
	
	$return['page_prev'] = '?q='. $q;
	if ($npag > 1) {
		$return['page_prev'] .= !empty($pageTokenPrev) ? '&pageToken='. $pageTokenPrev : '';
	}
	
	$return['items'] = $items;

	return $return;
}

	//CONDICION QUE MOSTRARA datos
//	try {

if ($q) {
	$dataFeed = leer_feed($q, $npag, $cant);
	$vid = $dataFeed['items'];
	//ECHO "<PRE>"; print_r($vid);EXIT;
	$num = count($vid, COUNT_RECURSIVE);
/*
	for ($i = 0; $i < $cant; $i++) {
		$video[$i]=array(
			'titulo'		=> $vid[$i]['titulo'],
			'id'			=> $vid[$i]['id'],
			'img'			=> $vid[$i]['img'],
			// 'duracion'		=> $vid[$i]['duracion'],
			//'pag_video' 	=> $vid[$i]['pag_video'],
			// 'pag_tag'		=> $vid[$i]['pag_tag'],
			'descripcion'	=> $vid[$i]['descripcion'],
			'contador_view'=> $vid[$i]['contador_view'],
			'etiqueta'		=> $vid[$i]['etiqueta']
		);
	}*/

}//FIN de IF


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
