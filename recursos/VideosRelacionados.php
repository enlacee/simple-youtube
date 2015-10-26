<?php

class VideosRelacionados {

	private $id;
	private $page;	
	
	//constructor
	public function __construct( $id, $page )
	{
		if(empty($id)) {
			echo "id no existe"; exit;
		}
		$this->readConfig();

		$this->id = $id;
		$this->page = $page;		
		$this->imprimir($this->id, $this->page);
	}
	
	public function getID()
	{ 
		return $this->id;
	}

	/**
	* void read variables 
	*/
	public function readConfig()
	{
		$configuracion = parse_ini_file("config/config.ini", TRUE);
		$this->config = $configuracion;

		return $this->config;
	}
	

	/**
	* Create URL api
	* https://www.googleapis.com/youtube/v3/search?part=snippet&relatedToVideoId=5rOiW_xY-kc&type=video&key={YOUR_API_KEY}
	*/
	public function cargarDatos($maxResults = 5)
	{

		$config = $this->readConfig();
		$api_url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&relatedToVideoId='. $this->getID() 
			. '&maxResults=' . $maxResults
			.'&type=video&key=' . $config['pagina']['your_api_key'];

		
		$string = file_get_contents($api_url);
		$json = json_decode($string, true);
		$video = array();

		if (!is_null($json) && is_array($json) && isset($json['pageInfo'])) {
			foreach ($json['items'] as $key => $value) {
				$data_id = $value['id']['videoId'];
				$data_O1 = $value['snippet'];
				$url_amigable = urls_amigables($data_O1['title']);

				$video[] = array(
					'titulo' => $data_O1['title'],
					'url' => 'https://www.youtube.com/watch?v=' . $data_id,
					'id' => $data_id,
					'img' => $data_O1['thumbnails']['medium']['url'],
					'pag_vid' => $config['pagina']['host'] . $data_id . '-' . $url_amigable.'.html',
					'pag_etiqueta' => 'video.php?tag=',
					'duracion' => '123',
					'contador_view' => '',
					'etiqueta' => ''
				);

			}
		}
		return $video;
	
	}
	
	//--------------------------------
	public function imprimir($ide, $num_pag){ //AKi puede pasar parametro de pagina y ++		
		
		if(!isset($num_pag))
			$page = 1;
		else 
			$page = $num_pag;
		
		$cant = 15;		
		$video = $this->cargarDatos($cant);		
		
		$num = count($video);
		if (!empty($num)) {
			
			for($i = 0; $i < $cant; $i++) {
				if($video[$i]['id']!="") {
					$html  = '<div class="images">';
			        $html .= '<div class="img">';					
			        $html .= '<a  href="'.$video[$i]['pag_vid'].' " ><img class ="item-hd" src="'.$video[$i]['img'].'" /></a></div>';
					$html .= '';
					$html .= '<p><a  title ="'.$this->aMinusculas($video[$i]['titulo']).'" href="'.$video[$i]['pag_vid'].'">'.$video[$i]['titulo'].'</a> </p> ';
		
					$html .= '<span>duracion: '.$video[$i]['duracion'].' | visto: '.$video[$i]['contador_view'].' veces</span> ';			
					$html .= '</div>';
					
					echo $html;
				}			
			}//fin FOR

			// Paginacion::
			//	$html  = '<div class="both"></div>';
			//	$html .= '<div id="paginador">';				
				
			//	if ($page==2)
			//	$html .= '<span id="pag-isquierda"><a href="?v='.$ide.'"><< Anterior</a></span>';
			//	elseif($page!=1 /*||$page != 0*/)
			//	$html .= '<span id="pag-isquierda"><a href="?v='.$ide.'&p='.($page-1).'"><< Anterior</a></span>';	
		
			//	$html .= '<span id="pag-derecha"><a href="?v='.$ide.'&p='.($page+1).'"> Siguiente >></a></span>';				
			//	$html .= '</div>';
			//	$html .= '<div class="both"></div>';
				
			//	echo $html;			
			
		} else {
			echo "No se encontraron resultados...";
		}
	}
	

// -------- -------- -------- ------- ------- ------//	
	function aMinusculas($cadena){
		return strtolower($cadena);
	}	
	function getIde($cadena){			
		return substr($cadena,31,11);
	}
	function descripcion_c($texto){
		return substr($texto,0,150);	
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

// -------- -------- -------- ------- ------- ------//	
	
	
/*

	
	private function titulo_corto($tit){
		$tit_nuevo =(substr($tit,0,40));
		return $tit_nuevo;
	}
	
	private function foto_grande($thumb){
		$imagen	=(substr($thumb,0,34)).'0.jpg';
		return $imagen;
	}

	*/

}//Fin de la clase

/*	$buscar1 = new BuscarVideo('miley',9,1);
	$buscar1->imprimir();
*/

?>