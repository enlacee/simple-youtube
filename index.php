<?php
if (empty($_GET['q'])) {
	header('Location: home.php');
}
include 'recursos/functions.php'; ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Search</title>
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
    <div class="linea"></div>

    <div id="contenedor">
    <div id="modulo">
    <?php if (isset($num) && $num > 0): ?>
        <div id="medio">
            <h2>Videos Found...</h2>
        </div>
        <?php for ($i = 0; $i < $cant; $i++): ?>
        <?php if ($vid[$i]['id'] != ""): ?>
        <div class="images">
            <div class="img">
                <a	href="<?php echo $vid[$i]['pag_video']; ?>" > <img src=' <?php echo $vid[$i]['img']; ?> 'alt=' <?php echo $vid[$i]['titulo']; ?> '></a>
            </div>
            <p><?php echo '<a title="'.$vid[$i]['titulo'].'" href="'.$vid[$i]['pag_video'].'">'.$vid[$i]['titulo'].'</a>'; ?></p>
        </div>
        <?php endif ?>
        <?php endfor; ?>
    <?php endif ?>
    </div>

    <div class="both"></div>

    <?php if (isset($num) && $num > 0) { ?>
        <div id="paginador">
        <?php if ($page==2)
        		echo '<span><a href="'.$dataFeed['page_prev'].'"><< Prev</a></span>';
        	elseif($page!=1 /*||$page != 0*/)
        		echo '<span><a href="'.$dataFeed['page_prev'].'&p='.($page-1).'"><< Prev </a></span>';

        	echo '<span><a href="'.$dataFeed['page_next'].'&p='.($page+1).'"> Next >></a></span>';?>
        </div>
        <div class="both"></div>
    <?php } ?>


    <div class="both"></div>
    </div><!-- fin contenedor -->

    <!-- pie de pagina-->
    <div id="pie"><a href="<?php echo $HOST; ?>"><?php echo $titulo; ?></a></div>

</div>
</body>
</html>
