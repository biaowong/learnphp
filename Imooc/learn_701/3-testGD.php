<?php
$image  = imagecreatetruecolor(500, 500);
$white = imagecolorallocate($image, 255, 255, 255);
$randColor = imagecolorallocate($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
// 绘制填充矩形
imagefilledrectangle($image, 0, 0, 500, 500, $white);
// 绘制字体
$fonts = 'D:/www/PHPLearning/imooc/learn_701/fonts/hwkaiti.ttf';
imagettftext($image, 20, 0, 100, 100, $randColor, $fonts, "This is king show time");
imagettftext($image, 30, 40, 200, 200, $randColor, $fonts, "IMooc");
header('content-type:image/PNG');
// 输出图片
imagepng($image);
imagedestroy($image);
