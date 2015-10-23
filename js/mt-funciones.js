// JavaScript Document

var host = "http://textoconbrillo.org/video/enviar-mail.php"


function peticion(){	
	alert("en proceso");
	var url = "http://localhost/tiernoamor-servidor/index.php?q=maria";
	new Ajax(url, {
			method: 'get',
			// metodo ajax get o post
			update: $('youtube')
			// donde se va  a insertar el resultado
			}).request();
}


function enviarMail(){	
	 if($('emisor_name').value==''){alert('Ingresa tu nombre');$('emisor_name').focus();return false}
	 if(!verificaemail($('emisor_mail').value)){alert('Ingrese un email valido');$('emisor_mail').focus();return false}
	   
	 if($('receptor_name').value==''){alert('Ingrese destinatario(s)');$('receptor_name').focus();return false}    
	 if(!verificaemail($('receptor_mail').value)){alert('Ingrese un email valido');$('receptor_mail').focus();return false}
	
	$('popup-cuerpo').style.display='none'
	$('rpta_ajax').style.display='block'
		
	var paramEnviar  = 'video_id='+$('video_id').value+'&emisor_name='+$('emisor_name').value+'&emisor_mail='+$('emisor_mail').value+'&receptor_name='+$('receptor_name').value+'&receptor_mail='+$('receptor_mail').value+'&emisor_mensaje='+$('emisor_mensaje').value;      
	    paramEnviar += '&id='+$('id').value;
	alert ('PARAMETROS ENVIADOS :: '+paramEnviar);
	   
	var url ='http://localhost/video/enviar-mail.php';
	alert('entrando EN AJAX');
	var miAjax = new Ajax(url,{
			method: 'post',
			data: ''+paramEnviar,
			update: $('rpta_ajax')
			
		});
		miAjax.request();
		alert ('modifique :: js/mt-funciones.js= linea 32::  y poner Tu URL_HOST');
	
}


/***************/
function verificaemail(mail){
    var s = mail;
    var filter=/^[A-Za-z][A-Za-z0-9._]*@[A-Za-z0-9_]+\.[A-Za-z0-9_.]+[A-za-z]$/;
    if (filter.test(s)){
        return true;
    }else{
        return false;
    }
}
/**************/	
	
	
	
	

function verEm(){
	$('divENVXMAIL').style.display='block'
	$('popup-cuerpo').style.display='block'	
	}


function cerrarEm(){ 
	$('rpta_ajax').style.display='none'
	$('divENVXMAIL').style.display='none'
		
    $('emisor_name').value=''
    $('emisor_mail').value='' 
    $('receptor_name').value=''
    $('receptor_mail').value=''	
    $('emisor_mensaje').value=''
    
    $('').value=''                                   
}

