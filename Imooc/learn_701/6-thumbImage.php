<?php
$filename = 'images/test.jpg';
$fileInfo = getimagesize($filename);
list($src_w, $src_h) = $fileInfo;

$dst_w = 100;
$dst_h = 100;
// 创建目标画布资源
$dst_image = imagecreatetruecolor($dst_w, $dst_h);
$src_image = imagecreatefromjpeg(($filename));
imagecopyresampled($dst_image, $src_image, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
header("content-type:image/jpeg");
imagejpeg($dst_image);
imagedestroy($src_image);
imagedestroy($dst_image);
