<?php

$category = !empty($_REQUEST['category']) ? $_REQUEST['category'] : '';
$category = "music";

$arreglo = array(
	0	=> array("titulo" => "Selena Gomez", 	"id" => "M8uPvX2te0I"),
	1	=> array("titulo" => "Demi Lovato",		"id" => "CwEdKLw-E5w"),
	2	=> array("titulo" => "Megan fox",		"id" => "JooN-5yFors"),
	3	=> array("titulo" => "Lady gaga",		"id" => "qrO4YZeyl0I"),
	4	=> array("titulo" => "Eminem",			"id" => "KrLXpiVtAwg"),
	5	=> array("titulo" => "Shakira",			"id" => "_3-GiVIE8gc"),
	6	=> array("titulo" => "Miley cyrus",		"id" => "My2FRPA3Gf8"),
	7	=> array("titulo" => "Ashley tisdale",	"id" => "On_ZPiDEqkA"),
	9	=> array("titulo" => "Celine Dion",		"id" => "FJw3YfRDnA4"),
	10	=> array("titulo" => "Kylie Minogue",	"id" => "frv6FOt1BNI"),
	11	=> array("titulo" => "Britney Spears",	"id" => "e7Fb3guhga8"),
	12	=> array('titulo' => 'Rita Ora', 		'id' => 'Q1fGOG3XXIQ'),
	13	=> array('titulo' => 'Taylor Swift',	'id' => 'e-ORhEE9VVg')
);
shuffle($arreglo);

$html = '';
for ($i = 0; $i < count($arreglo); $i++) {
	$html .='<div class="images">';
	$html .='<div class="img">';
	$html .='<a href="index.php?q='.str_replace(' ', '+', $arreglo[$i]['titulo']).'">';
	$html .='<img src="http://img.youtube.com/vi/'.$arreglo[$i]['id'].'/hqdefault.jpg" >';
	$html .='</a>';
	$html .='</div>';
	$html .='<p>'.$arreglo[$i]['titulo'].'</p>';
	$html .='</div>';
}
