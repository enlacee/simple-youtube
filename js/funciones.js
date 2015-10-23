// JavaScript Document
function presionSubmit(){
	var feed = 'http://gdata.youtube.com/feeds/api/standardfeeds/top_favorites';
	/*var string = "feed="+feed;*/
	alert ("enviado solicitud");

	$.ajax({ 
           async:true,
           type: "GET",
		   dataType: "html",//debuelbe en html
           contentType: "application/x-www-form-urlencoded",
           url:"http://localhost/tiernoamor-servidor/formulario.php",
           data: string,
		   
		   beforeSend: inicioEnvio,
		   success: llegadaDatos		   
         });	
}//fin de metodo presionSubmit

function inicioEnvio(){
	var cargando = $('#youtube');
		cargando.html('<div id="load"><img src="img/load.gif" width="160" height="24" /><br />cargando...</div>');		
}//fin de metodo inicioEnvio

function llegadaDatos(datos){
	$('#youtube').html(datos);
}

$(document).ready( DD_roundies.addRule('.modulo', '5px', true) );
$(document).ready( DD_roundies.addRule('.img', '3px 3px 3px 3px', true) );
$(document).ready( DD_roundies.addRule('.busca', '5px', true) );