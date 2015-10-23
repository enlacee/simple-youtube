<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Untitled Document</title>
<style type="text/css">
<!--

html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,font,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td{border:0;outline:0;vertical-align:baseline;background:transparent;margin:0;padding:0;}

body{
	/*background:#FFF url(images/tu-no-sabes.png) no-repeat right top;*/
	font-size:100%;
	color:#999999;	
	font-family: arial, Tahoma, "Lucida Sans Unicode", "Lucida Grande", verdana, geneva, sans-serif;
	letter-spacing:0.01em;
	}

#contenedor{
	background:#FFFFFF url(images/tu-no-sabes.png) no-repeat right top;
	margin:0 auto 0 auto;
	padding:5px;
	width:400px;
}

/* ---------------------------------- Formulario ----------------------------------*/


#enviar{/*boton enviar*/
	background-color:#E7E6E0;	
}





input,textarea{
	background-color:#FFFFFF;
	border:1px solid #ACACAC;	
	font-size:18px/20px verdana;
	
	display:block;
	margin:3px 0 0 10px;

}
.negrita{
	font: bold 12px/25px Arial;
	color: #555555;
	text-align:right;
}

.texto{
display:block;
width:50px;
padding:0 0 0 10px;
font:10px/10px arial;
}

-->
</style>


</head>

<body>
<div id="contenedor">

<div id="form-enviar-mail">

<form method="post" action="enviar-mail.php">
  <p><span class="negrita">de:</span>
      <span class="texto">nombre</span><input type="text" name="emisor_name" size="20" id="emisor_name" />
      <span class="texto">mail</span><input type="text" name="emisor_mail" size="30" id="emisor_mail" />
  </p>
  <p><span class="negrita">para:</span><span class="texto">nombre</span>
    <input type="text" name="receptor_name" size="20" id="receptor_name" />
    <span class="texto">mail</span><input type="text" name="receptor_mail" size="30" id="receptor_mail" />
  </p>
  <p><span class="negrita">Tu mensaje</span></p>     
    <textarea name="emisor_mensaje" rows="5" cols="29" id="emisor_mensaje"></textarea>
  
  <p>&nbsp;</p>
  <p>
    <input id="enviar" type="submit" value="Enviar"/>    
    <br />
    <input type="hidden" name="url2" size="30" value="<?php echo $_REQUEST['url']; ?>" />
    <br />
          </p>


</form>

</div>







</div>
</body>
</html>
