<?php	include 'recursos/functions.php'; ?>
<?php	include 'recursos/feedYoutube.php'; ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Home</title>
</head>
<body>
	<div id="pagina">
		<div id="header"></div>

		<div id="buscador">
			<form name="b_vi" action="index.php" method="get">
			<input id="q"	type="text" name="q" size="30" value="<?php echo !empty($_GET['q']) ? $_GET['q'] : ''; ?>" class="input">
			<input  type="submit" id="send"  value="Search Videos">
			</form>
		</div>

		<div id="contenedor">
			<?php echo $html ?>
			<div class="both"></div>
		</div>


		<div id="pie">
			<a href="<?php echo $HOST; ?>"><?php echo $titulo; ?></a>
		</div>
	</div>
</body>
</html>
