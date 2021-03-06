<?php
session_start(); // Staring Session
$captchanumber = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz'; // Initializing PHP variable with string
$captchanumber = substr(str_shuffle($captchanumber), 0, 5); // Getting first 6 word after shuffle.
$_SESSION["code"] = $captchanumber; // Initializing session variable with above generated sub-string
$im = imagecreatetruecolor(60, 25);
$bg = imagecolorallocate($im, 22, 86, 165); //background color blue
$fg = imagecolorallocate($im, 255, 255, 255);//text color white
imagefill($im, 0, 0, $bg);
imagestring($im, 5, 5, 5, $captchanumber, $fg);
header('Content-type: image/png');
imagepng($im);
imagedestroy($im);
?>