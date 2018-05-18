<?php
// 创建画布
$width = 400;
$height = 50;
$image = imagecreatetruecolor($width, $height);
$white = imagecolorallocate($image, 255, 255, 255);
imagefilledrectangle($image, 0, 0, $width, $height, $white);
$randColor = imagecolorallocate($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
$size = mt_rand(20, 28);
$angle = mt_rand(-15, 15);
$x = 50;
$y = 30;
$fontFile = 'D:/www/PHPLearning/imooc/learn_701/fonts/hwkaiti.ttf';
$text = mt_rand(1000, 9999);
imagettftext($image, $size, $angle, $x, $y, $randColor, $fontFile, $text);
header('content-type:image/png');
imagepng($image);
imagedestroy($image);
