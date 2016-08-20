<?php error_reporting(0);?><?php session_start();?><?php //define('_PHP_DOT_PRO','ebdbf06090f7fcd532551060fb9a5543');
$im = imagecreatetruecolor(200, 100);
$white = ImageColorAllocate($im, 255, 255, 255); 
$grey = ImageColorAllocate($im, 145, 181, 120);
$black = imagecolorallocate($im, 0, 0, 0);
srand((double)microtime()*1000000000); 
$string = md5(rand(0,999999));
$_SESSION[new_string]="";  
$_SESSION[new_string] = strtoupper( substr($string, 17, 4)); 
ImageFill($im, 0, 0, $grey);
//ImageString($im, 7, 80, 10, $_SESSION[new_string], $white);
imagettftext($im,25,10,6,51,$black,'images/verdana.ttf',$_SESSION[new_string]);
imagettftext($im,25,10,5,50,$white,'images/verdana.ttf',$_SESSION[new_string]);
  
header('Content-type: image/png');
imagepng($im);
imagedestroy($im);

//
//
//// Create the image
//$im = imagecreatetruecolor(400, 30);
//
//// Create some colors
//$white = imagecolorallocate($im, 255, 255, 255);
//$grey = imagecolorallocate($im, 128, 128, 128);
//$black = imagecolorallocate($im, 0, 0, 0);
//imagefilledrectangle($im, 0, 0, 399, 29, $white);
//
//// The text to draw
//$text = 'Testing...';
//// Replace path by your own font path
//$font = 'arial.ttf';
//
// //Add some shadow to the text
//imagettftext($im, 20, 0, 11, 21, $grey, $font, $text);
//
// //Add the text
//imagettftext($im, 20, 0, 10, 20, $black, $font, $text);
//// Set the content-type
//header("Content-type: image/png");
//// Using imagepng() results in clearer text compared with imagejpeg()
//imagepng($im);
//imagedestroy($im);
?>