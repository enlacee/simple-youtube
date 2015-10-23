	
<?php	//VideosRelacionados( idvideo )



class VideosRelacionados{//ingresa idvideo 

	private $id;
	private $page;	
	
	//constructor
	public function __construct( $id,$page ){
		if(empty($id))
			echo "ESTA VACIO  idddddddd AAAAA AAA";
		$this->id = $id;
		$this->page = $page;
		
		$this->imprimir($this->id, $this->page);
	}
	
	function getID(){ return $this->id;	}
	
	private function generaFeed(){// http://gdata.youtube.com/feeds/api/videos/UEr91A_Rewc/related
		$salida = 'http://gdata.youtube.com/feeds/api/videos/'.$this->getID().'/related';		
		return 	$salida;
	}
	//---------------------------------------------------------
	
	public function cargarDatos(){
	
		$feedURL = $this->generaFeed();
			
		$sxml = simplexml_load_file($feedURL);
			$i=0;

		foreach ($sxml->entry as $entry) {			
		//global $i; 
				$i = $i + 1;	
		// get nodes in media: namespace for media information

		$media = $entry->children('http://search.yahoo.com/mrss/'); 
		$attrs = $media->group->player->attributes();		
		$url[$i]  		= $attrs['url'];	
		$titulo[$i]		= $media->group->title;
		$descripcion[$i]= $media->group->description;
		$etiqueta[$i]	= $media->group->keywords;

		
		// get thumbnail
		$attrs = $media->group->thumbnail[0]->attributes();
		$img[$i]		= $attrs['url'];
		
		// get duracion
		$yt = $media->children('http://gdata.youtube.com/schemas/2007');
		$attrs = $yt->duration->attributes();
		$seg[$i]		= $attrs['seconds'];
			
		// get vistos
		$yt = $entry->children('http://gdata.youtube.com/schemas/2007');
		$attrs = $yt->statistics->attributes();
		@$viewCount[$i]=$attrs['viewCount'];				//ERROR POSBILEEEE
		
		// get ranking
		$gd = $entry->children('http://schemas.google.com/g/2005'); 
		if ($gd->rating) {
			$attrs 		= $gd->rating->attributes();
			$rating[$i] = $attrs['average'];
		} else {
			$rating[$i] = 0;
		}	
		
		
		$url_amigable = (urls_amigables($titulo[$i]));
		//-------------
		$configuracion = parse_ini_file("config/config.ini",TRUE);
		//variables
		$HOST 	= $configuracion[pagina][host];

		// Creando Array almacen de DATOS		
		$video[$i]=array(
				 'titulo'		=> $titulo[$i],
				 'id'			=> $this->getIde($url[$i]),//"http://img.youtube.com/vi/".getIde($url_t)."/hqdefault.jpg",
				 'img'			=> 'http://img.youtube.com/vi/'.getIde($url[$i]).'/hqdefault.jpg',
				 'duracion'		=> $this->minutes($seg[$i]),
				 'pag_vid' 		=> $HOST.getIde($url[$i]).'-'.$url_amigable.'.html',
				 'url_amigable' => 'http://localhost/servidor/ver/'.getIde($url[$i]).'/'.$url_amigable.'/', 
			//	 'pag_tag'		=> 'video.php?tag=',
			//	 'descripcion'	=> $descripcion[$i],
				 'contador_view'=> $viewCount[$i],
				 'etiqueta'		=> $etiqueta[$i]);

	}//fin del  foreach
		return $video;
	
	}//fin de la funcion Imprimir
	
	//--------------------------------
	public function imprimir($ide, $num_pag){ //AKi puede pasar parametro de pagina y ++		
		
		if(!isset($num_pag))
			$page = 1;
		else 
			$page = $num_pag;
		
		
		$cant		= 15; //Cantidad de videos a mostrar por pagina.			
		$video = $this->cargarDatos();		
		
		$num =count($video);		
		if(!empty($num)) {
			
			for($i=0; $i<=$cant; $i++) {
				if($video[$i]['id']!="") { //asegura q no halla vacio en Feed

					
					
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
			echo "NO SE ENCONTRARON RESULTADOS...[num]= $num";
		}//fin IF ELSE PRINCIPAL
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