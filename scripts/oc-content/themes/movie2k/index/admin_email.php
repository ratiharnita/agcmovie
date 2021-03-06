<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/oc-load.php');
$imc = imagecreatetruecolor(200, 25);
$bgc = imagecolorallocate($imc, 22, 86, 165); //background color blue
$fgc = imagecolorallocate($imc, 255, 255, 255);//text color white
imagefill($imc, 0, 0, $bgc);
imagestring($imc, 3, 3, 3, get_bloginfo('email'), $fgc);
header('Content-type: image/png');
imagepng($imc);
imagedestroy($imc);
?>