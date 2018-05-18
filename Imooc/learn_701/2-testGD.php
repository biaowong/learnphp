<?php
// 1.创建画布
$width = 500;
$height = 300;
$image = imagecreatetruecolor($width, $height);
// 2.创建颜色
$red = imagecolorallocate($image, 255, 0, 0);
$blue = imagecolorallocate($image, 0, 0, 255);
$white = imagecolorallocate($image, 255, 255, 255);
// 3.开始绘画
// 水平的绘制一个字符
imagechar($image, 5, 50, 100, 'K', $red);
imagecharup($image, 5, 100, 200, 'I', $blue);
// 水平绘制字符串
imagestring($image, 5, 100, 150, 'imooc', $white);
// 4.告诉浏览器以图片的形式来显示
header('content-type:image/jpeg');
// 5.输出图像
imagejpeg($image);
// 销毁资源
imagedestroy($image);
