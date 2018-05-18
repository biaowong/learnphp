<?php
$filename = 'images/test.jpg';
$fileInfo = getimagesize($filename);
$mime = $fileInfo['mime'];
$createFun = str_replace('/', 'createfrom', $mime);
$outFun = str_replace('/', null, $mime);
$image = $createFun($filename);
// $red = imagecolorallocate($image, 255, 0, 0);
$red = imagecolorallocatealpha($image, 255, 0, 0, 70);
$fontfile = __DIR__.DIRECTORY_SEPARATOR.'fonts'.DIRECTORY_SEPARATOR.'hwkaiti.ttf';
imagettftext($image, 30, 0, 0, 30, $red, $fontfile, '区块链');
header('content-type:'.$mime);
$outFun($image);
imagedestroy($image);
