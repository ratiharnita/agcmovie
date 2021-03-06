<?php
session_start();
$code=mt_rand_str(5, 'abcdefghijklmnopqrstuvwxyz1234567890');
$_SESSION["code"]=$code;
$im = imagecreatetruecolor(55, 24);
$bg = imagecolorallocate($im, 22, 86, 165); //background color blue
$fg = imagecolorallocate($im, 255, 255, 255);//text color white
imagefill($im, 0, 0, $bg);
imagestring($im, 5, 5, 5,  $code, $fg);
header("Cache-Control: no-cache, must-revalidate");
header('Content-type: image/png');
imagepng($im);
imagedestroy($im);
?>