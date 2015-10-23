// JavaScript Document

var msgerror="Usuario o contraseña incorrecto<br><a href='javascript:void(0)' onclick='cDivImpCont()'>Intentar nuevamente</a>"
var msg_env_1
var msg_env_2
var emails_importados
var n_emails
var por_in=0
var emailsxenv=10//10
var index=0
var em_anv=0
var op_env
var ajaxEnvMail
var parm_env
function imp_contactos(){
    if(!verificaemail($('tucuenta').value)){alert('Por favor ingrese un email valido');$('tucuenta').focus(); return false}
    if($('tuclave').value==''){alert('Por favor ingrese su clave');$('tuclave').focus(); return false}
    mos_div()
    $('divImp').innerHTML='<br><br><br>Extrayendo contactos...<img src="/images/cargando.gif"><label class="msgec">Un Momento Por favor.... esta Operacion puede durar unos min. segun al nro de contactos que tengas.</label>'
    
    var params="email="+$('tucuenta').value+"&clave="+$('tuclave').value+"&nombre="+$('tunombre').value
    var ajaxC = new Ajax('/importar_contactos.aspx',{method: 'post',data:params,onComplete: function(request){		        
	if(request==1){
	    $('divImp').innerHTML=msgerror
	}else{
        emails_importados=eval(request) 
	    n_emails=emails_importados.length
	    var s = new Array();	
	    s[s.length]="<div class='c_eimp_t'><input type='checkbox' id='em_tod' onclick='sel_tod(this,1)'>Seleccionar todos</div>"
	    s[s.length]="<div class='c_eimp' id='c_eimp'>"
	    for(i=0;i<=n_emails-1;i++){
	        if(emails_importados[i].email!='')
	        s[s.length]="<span><input type='checkbox' value='"+emails_importados[i].email+"' id='em_im"+i+"' onclick='sel_tod(this,0)'>"+emails_importados[i].email+'</span>';	        
	    }	    
	    s[s.length]="</div>"
	    $('divImp').innerHTML=s.join("");
    }
    }});ajaxC.request();
}
/************************/

/*************************/


function e_m(op){
    if (op == 0) { cerrar_ic(); /*$('divENVXMAIL').style.display='none';cDivImpCont()*/ }
    else {
    $('headerInner2').appendChild($('divENVXMAIL'));
    $('divENVXMAIL').style.display='block'
    }
}
function cDivImpCont(){
    if($('divImp')){$('divImp').style.display='none';$('tuclave').value='';}
}
function mos_div(){
    if(!$('divImp')){
        var divCarg=document.createElement("div");
	    divCarg.id='divImp'
	    divCarg.className='divImporCont'
	    $('bopcont1').appendChild(divCarg)                
    }else{
        $('divImp').style.display='block'
	}
}
function impo_cnt(e){
    tecla = (document.all) ? e.keyCode : e.which;
	if (tecla==13){imp_contactos(); return false}
}
function verificaemail(mail){
    var s = mail;
    var filter=/^[A-Za-z][A-Za-z0-9_]*@[A-Za-z0-9_]+\.[A-Za-z0-9_.]+[A-za-z]$/;
    if (filter.test(s)){
        return true;
    }else{
        return false;
    }
}
function sel_tod(obj,op){       
       var obinp=document.getElementById('c_eimp').getElementsByTagName('input');
       var emails_ag=''
       var salt_lin=''
       var ii=0
       $('destinatarios').value=$('destinatarios').value.replace(/^\s*|\s*|\n*$/g,"");
       for(i=0;i<=obinp.length-1;i++){
        if (ii % 2){salt_lin='\n'}
        
        if(op==1 && obj.checked)obinp[i].checked=true
        if(op==1 && obj.checked==false)obinp[i].checked=false
        
        $('destinatarios').value=$('destinatarios').value.replace(obinp[i].value+',',"")
        if(obinp[i].checked){                
		//emails_ag=emails_ag+obinp[i].value+','+salt_lin
		$('destinatarios').value += obinp[i].value+','+salt_lin
		ii++;
		salt_lin='';
		}								
	   }	   
	   $('destinatarios').value=$('destinatarios').value.replace(/^\s*|\s*$/g,"");
	   //$('destinatarios').value=emails_ag	   
}

function envVideo(){
    if($('tunombre').value==''){alert('Ingresa tu nombre');$('tunombre').focus();return false}
    if(!verificaemail($('tuemail').value)){alert('Ingrese un email valido');$('tuemail').focus();return false}
    if($('destinatarios').value==''){alert('Ingrese destinatario(s)');$('destinatarios').focus();return false}    
    emails_importados=$('destinatarios').value.split(',')    
    n_emails=emails_importados.length
    if(!$('divEnv')){
        var divCarg=document.createElement("div");
	    divCarg.id='divEnv'
	    divCarg.className='divCargando'
	    $('cntg').appendChild(divCarg)
    }else{
        $('divEnv').style.display='block'
	}
	if($('divEnv'))$('divEnv').innerHTML='<div id="msgprog">'+msg_env_1+'</div><div id="cBarra"><div id="Barrita"></div></div><div id="porcenv">'+por_in+'%<br><label id="msgec">Un Momento Por favor.... esta Operacion puede durar unos min. segun al nro de contactos que tengas.</label></div>'	        	        	        	        
	ajaxEnv();
}
function ajaxEnv(){
    var em=emails_a_enviar();    
    if(op_env==1){
        parm_env='op_env='+op_env+'&emails='+em+'&nombre='+$('tunombre').value+'&tumensaje='+$('tumensaje').value+'&fotousuario='+$('fotoUs').value+'&url_cont_env='+$('url_cont_env').value+'&link_cont_env='+$('link_cont_env').value
    }else{
        var dvideo=""        
        if($('des_cont_env')){dvideo="&titulo_cont_env="+$('titulo_cont_env').value+"&des_cont_env=" + $('des_cont_env').value}        
        parm_env='op_env='+op_env+'&emails='+em+'&nombre='+$('tunombre').value+'&tumensaje='+$('tumensaje').value+'&imgvideo='+$('imgvideo').value+'&fotousuario='+$('fotoUs').value+'&url_cont_env='+$('url_cont_env').value+'&link_cont_env='+$('link_cont_env').value+'&tu_email='+$('tuemail').value+dvideo
    }
    
    ajaxEnvMail = new Ajax('/ajax/enviar_video.aspx',{method: 'get',data:parm_env,onComplete: function(request){req_env(request)}});ajaxEnvMail.request();	
}
function emails_a_enviar(){
    var txt=''
    var j=1
    for (var i=index; i < n_emails; i++) {                                    
        txt=txt + emails_importados[i] + ','                            
        if(j==emailsxenv) i=n_emails
        j++;
        em_anv=em_anv+1
    }
    txt=txt.replace(/undefined/g,'')
    txt=txt.replace(/,,/g,'')
    return txt.replace(/undefined/g,'')
}
function req_env(request){    
    $('Barrita').style.width=((em_anv*100)/n_emails)+'%'
    $('porcenv').innerHTML=Math.round(((em_anv*100)/n_emails))+'%'
    index=index+emailsxenv
    if(em_anv<n_emails)
        ajaxEnv();
    else{
        $('msgprog').innerHTML=msg_env_2
        $('porcenv').innerHTML=$('porcenv').innerHTML + '<BR><br><input type="button" value="Cerrar ventana" onclick="cerrar_ic()">'
    }
}
function cerrar_ic(){            
    index=0
    em_anv=0
    if($('divEnv'))$('divEnv').style.display='none'
    cDivImpCont()
    $('divENVXMAIL').style.display='none';
    $('tunombre').value=''
    $('tuemail').value='' 
    $('destinatarios').value='' 
    $('tumensaje').value=''
    
    $('tucuenta').value=''                                   
}
 function env_con_ent(e){
  tecla = (document.all) ? e.keyCode : e.which;
	            if (tecla==13){envVideo(); return false}
}
        