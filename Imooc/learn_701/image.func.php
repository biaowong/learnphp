<?php
/**
 * 指定缩放比例
 * 最大宽度和高度，等比例缩放
 * 可以对缩略图文件添加前缀
 * 选择是否删除缩略图源文件
 */

/**
 * 返回图片信息
 * @param  string $filename 文件名
 * @return array            包含图片的宽度、高度、创建和输出字符串以及扩展名
 */
function getImageInfo($filename)
{
    if (@!$info = getimagesize($filename)) {
        exit('文件不是真实图片');
    }

    $fileInfo['width'] = $info[0];
    $fileInfo['height'] = $info[0];
    $mime = image_type_to_mime_type($info[2]);
    $createFun = str_replace('/', 'createfrom', $mime);
    $outFun = str_replace('/', '', $mime);
    $fileInfo['createFun'] = $createFun;
    $fileInfo['outFun'] = $outFun;
    $fileInfo['ext'] = strtolower(image_type_to_extension($info[2]));

    return $fileInfo;
}

/**
 * 形成缩略图的函数
 * @param  string  $filename  文件名
 * @param  string  $dest      缩略图保存路径，默认保存在thumb目录下
 * @param  string  $pre       默认前缀为thumb_
 * @param  int     $dst_w     最大宽度
 * @param  int     $dst_h     最大高度
 * @param  float   $scale     默认缩放比例
 * @param  boolean $delSource 是否删除源文件标志
 * @return srting             最终保存路径及文件名
 */
function thumb($filename, $dest='thumb', $pre='thumb_', $dst_w=null, $dst_h=null, $scale=0.5, $delSource=false)
{
    // $filename = 'images/test.jpg';
    // $pre = 'thumb_';
    // $dest = 'thumb';
    // $delSource = false;
    $fileInfo = getImageInfo($filename);
    // $scale = 0.5;
    // $dst_w = 200;
    // $dst_h = 300;
    $src_w = $fileInfo['width'];
    $src_h = $fileInfo['height'];

    // 如果指定最大高度和宽度，按照等比例缩放进行处理
    if (is_numeric($dst_w) && is_numeric($dst_h)) {
        $ratio_orig = $src_w / $src_h;
        if ($dst_w / $dst_h > $ratio_orig) {
            $dst_w = $dst_h * $ratio_orig;
        }
        else {
            $dst_h = $dst_w / $ratio_orig;
        }
    }
    else {
        // 按照默认的缩放比例进行处理
        $dst_w = ceil($src_w * $scale);
        $dst_h = ceil($src_h * $scale);
    }

    $dst_image = imagecreatetruecolor($dst_w, $dst_h);
    $src_image = $fileInfo['createFun']($filename);
    imagecopyresampled($dst_image, $src_image, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
    // 检测目标目录是否存在
    if ($dest && !file_exists($dest)) {
        mkdir($dest, 0777, true);
    }
    $randNum = mt_rand(100000, 999999);
    $dstName = "{$pre}{$randNum}".$fileInfo['ext'];
    $destination = $dest ? $dest.'/'.$dstName : $dstName;
    $fileInfo['outFun']($dst_image, $destination);

    imagedestroy($src_image);
    imagedestroy($dst_image);

    if ($delSource) {
        @unlink($filename);
    }

    return $destination;
}

/**
 * 文字水印
 * @param  string  $filename 图片路径
 * @param  string  $text     水印文字
 * @param  string  $dest     保存路径
 * @param  string  $pre      前缀
 * @param  booble  $delSource 是否删除源文件
 * @param  integer $r        rgb色值中的r
 * @param  integer $g        rgb色值中的g
 * @param  integer $b        rgb色值中的b
 * @param  integer $alpha    透明度
 * @param  integer $size     文字尺寸
 * @param  integer $angle    角度
 * @param  integer $x        坐标x
 * @param  integer $y        坐标y
 * @param  string  $fontfile 字体文件
 * @return string            文件保存路径
 */
function water_text($filename='images/test.jpg', $text='慕课网', $dest='waterText', $pre='waterText', $delSource=false, $r=255, $g=0, $b=0, $alpha=60, $size=30, $angle=0, $x=0, $y=30, $fontfile = __DIR__.DIRECTORY_SEPARATOR.'fonts'.DIRECTORY_SEPARATOR.'hwkaiti.ttf')
{
    $fileInfo = getImageInfo($filename);
    $image = $fileInfo['createFun']($filename);
    $color = imagecolorallocatealpha($image, $r, $g, $b, $alpha);
    imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
    // $dest = 'waterText';
    if ($dest && !file_exists($dest)) {
        mkdir($dest, 0777, true);
    }
    // $pre = 'waterText_';
    $randNum = mt_rand(100000, 999999);
    $dstName = "{$pre}_{$randNum}" . $fileInfo['ext'];
    $destination = $dest ? $dest . '/' . $dstName : $dstName;
    $fileInfo['outFun']($image, $destination);
    if ($delSource) {
        $unlink($filename);
    }
    imagedestroy($image);

    return $destination;
}

/**
 * 生成图片水印
 * @param  string  $dstName   图片路径
 * @param  string  $srcName   水印图片路径
 * @param  integer $pos       水印生成位置
 * @param  integer $pct       透明度
 * @param  string  $dest      目录
 * @param  string  $pre       前缀
 * @param  boolean $delSource 是否删除源文件
 * @return string             图片保存路径
 */
function water_pic($dstName='images/test.jpg', $srcName='images/jd.png', $pos=0, $pct=50, $dest='waterPic', $pre='waterPic', $delSource=false)
{
    $dstInfo = getImageInfo($dstName);
    $srcInfo = getImageInfo($srcName);
    $dst_im = $dstInfo['createFun']($dstName);
    $src_im = $srcInfo['createFun']($srcName);
    $src_width = $srcInfo['width'];
    $src_height = $srcInfo['height'];
    $dst_width = $dstInfo['width'];
    $dst_height = $dstInfo['height'];
    switch ($pos) {
        case 0:
            $x = 0;
            $y = 0;
            break;
        case 1:
            $x = ($dst_width - $src_width)/ 2;
            $y = 0;
            break;
        case 2:
            $x = $dst_width - $src_width;
            $y = 0;
            break;
        case 3:
            $x = 0;
            $y = ($dst_height - $src_height) / 2;
            break;
        case 4:
            $x = ($dst_width - $src_width)/ 2;
            $y = ($dst_height - $src_height) / 2;
            break;
        case 5:
            $x = $dst_width - $src_width;
            $y = ($dst_height - $src_height) / 2;
            break;
        case 6:
            $x = 0;
            $y = $dst_height - $src_height;
            break;
        case 7:
            $x = ($dst_width - $src_width)/ 2;
            $y = $dst_height - $src_height;
            break;
        case 8:
            $x = $dst_width - $src_width;
            $y = $dst_height - $src_height;
            break;

        default:
            $x = 0;
            $y = 0;
            break;
    }

    imagecopymerge($dst_im, $src_im, $x, $y, 0, 0, $src_width, $src_height, $pct);
    if ($dest && !file_exists($dest)) {
        mkdir($dest, 0777, true);
    }
    $randNum = mt_rand(100000, 999999);
    $dstName = "{$pre}_{$randNum}" . $dstInfo['ext'];
    $destination = $dest ? $dest . '/' . $dstName : $dstName;
    $dstInfo['outFun']($dst_im, $destination);
    imagedestroy($src_im);
    imagedestroy($dst_im);
    if ($delSource) {
        @unlink($filename);
    }

    return $destination;
}
