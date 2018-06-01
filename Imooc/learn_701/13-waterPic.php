<?php
$logo = 'images/jd.png';
$filename = 'images/test.jpg';

$dst_im = imagecreatefromjpeg($filename);
$src_im = imagecreatefrompng($logo);
imagecopymerge($dst_im, $src_im, 0, 0, 0, 0, 270, 60, 50);
header('content-type:image/jpeg');
imagejpeg($dst_im);
imagedestroy($src_im);
imagedestroy($dst_im);
