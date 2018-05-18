<?php
$width = 200;
$height = 40;
$image = imagecreatetruecolor($width, $height);
$white = imagecolorallocate($image, 255, 255, 255);

function getRandColor($image)
{
    return imagecolorallocate($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
}

imagefilledrectangle($image, 0, 0, $width, $height, $white);
$string = join('', array_merge(range(0, 9), range('a', 'z'), range('A', 'Z')));
// echo $string;
$fontFile = 'D:/www/PHPLearning/imooc/learn_701/fonts/hwkaiti.ttf';
$length = 4;
// 得到字体宽度
$textWidth = imagefontwidth(28);
// 得到字体高度
$textHeight = imagefontheight(28);
for ($i=0; $i < $length; $i++) {
    $size = mt_rand(20, 28);
    $angle = mt_rand(-15, 15);
    // $x = 20 + 40 * $i;
    // $y = 30;
    $x = ($width/$length)*$i + $textWidth;
    $y = mt_rand($height/2, $height-$textHeight);
    $text = str_shuffle($string){0};
    imagettftext($image, $size, $angle, $x, $y, getRandColor($image), $fontFile, $text);
}

// 添加干扰元素
// 添加像素点当做干扰元素
for ($i=1; $i <= 500; $i++) {
    imagesetpixel($image, mt_rand(0, $width), mt_rand(0, $height), getRandColor($image));
}

// 绘制线段当做干扰元素
for ($i=1; $i <= 3; $i++) {
    imageline($image, mt_rand(0, $width), mt_rand(0, $height), mt_rand(0, $width), mt_rand(0, $height), getRandColor($image));
}

// 绘制圆弧当做干扰元素
for ($i=1; $i <= 2; $i++) {
    imagearc($image, mt_rand(0, $width), mt_rand(0, $height), mt_rand(0, $width/2), mt_rand(0, $width/2), mt_rand(0, 360), mt_rand(0, 360), getRandColor($image));
}

header('content-type:image/png');
imagepng($image);
imagedestroy($image);
