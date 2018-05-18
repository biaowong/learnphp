<?php
$filename = 'images/test.jpg';
if ($fileInfo = getimagesize($filename)) {
    list($src_w, $src_h) = $fileInfo;
}
else {
    echo('文件不是真实图片');
}

$dst_w = 300;
$dst_h = 600;

// 设置最大宽高
$ratio_orig = $src_w / $src_h;
if ($dst_w / $dst_h > $ratio_orig) {
    $dst_w = $dst_h * $ratio_orig;
}
else {
    $dst_h = $dst_w / $ratio_orig;
}

$src_image = imagecreatefromjpeg($filename);
$dst_image = imagecreatetruecolor($dst_w, $dst_h);
imagecopyresampled($dst_image, $src_image, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
header("content-type:image/jpeg");
imagejpeg($dst_image);
imagedestroy($src_image);
imagedestroy($dst_image);
