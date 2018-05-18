<?php
/**
 * 默认生成4位数字验证码
 * @param  integer $type     1：数字 2：字母 3：数字+字母 4：中文
 * @param  integer $length   验证码长度
 * @param  string  $codeName 存入session的名字
 * @param  integer $pixel    干扰像素点数
 * @param  integer $line     干扰线数
 * @param  integer $arc      干扰弧线数
 * @param  integer $width    验证码宽度
 * @param  integer $height   验证码高度
 * @param  string  $fontFile 字体
 * @return void
 */
function getVerify($type=1, $length=4, $codeName='verifyCode', $pixel=50, $line=0, $arc=0, $width=200, $height=50, $fontFile=__DIR__.DIRECTORY_SEPARATOR.'fonts'.DIRECTORY_SEPARATOR.'hwkaiti.ttf') {

    $image = imagecreatetruecolor($width, $height);
    $white = imagecolorallocate($image, 255, 255, 255);
    imagefilledrectangle($image, 0, 0, $width, $height, $white);
    function getRandColor($image) {
        return imagecolorallocate($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
    }

    switch ($type) {
        case 1:
            // 数字
            $string = join('', array_rand(range(0, 9), $length));
            break;
        case 2:
            // 字母
            $string = join('', array_rand(array_flip(array_merge(range('a', 'z'), range('A', 'Z'))), $length));
            break;
        case 3:
            // 数字+字母
            $string = join('', array_rand(array_flip(array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'))), $length));
            break;
        case 4:
            // 汉子
            $str = "根,据,环,境,变,量,服,务,器,状,态,等,进,行,缓,存";
            $arr = explode(',', $str);
            $string = join('', array_rand(array_flip($arr), $length));
            break;

        default:
            exit('非法参数');
            break;
    }

    // 将验证码放入session中
    session_start();
    $_SESSION[$codeName] = $string;

    for ($i=0; $i < $length; $i++) {
        $size = mt_rand(20, 28);
        $angle = mt_rand(-15, 15);
        $x = 20 + ceil($width/$length) * $i;
        $y = mt_rand(ceil($height/3), $height-20);
        $color = getRandColor($image);
        $text = mb_substr($string, $i, 1, 'utf-8');
        imagettftext($image, $size, $angle, $x, $y, getRandColor($image), $fontFile, $text);

    }

    // 添加像素干扰元素
    if ($pixel > 0) {
        for ($i=1; $i <= $pixel; $i++) {
            imagesetpixel($image, mt_rand(0, $width), mt_rand(0, $height), getRandColor($image));
        }
    }

    // 添加线段干扰元素
    if ($line > 0 ) {
        for ($i=1; $i <= $line; $i++) {
            imageline($image, mt_rand(0, $width), mt_rand(0, $height), mt_rand(0, $width), mt_rand(0, $height), getRandColor($image));
        }
    }

    // 添加弧线当干扰元素
    if ($arc > 0) {
        for ($i=1; $i <= $arc; $i++) {
            imagearc($image, mt_rand(0, $width/2), mt_rand(0, $height/2), mt_rand(0, $width), mt_rand(0, $width), mt_rand(0, 360), mt_rand(0, 360), getRandColor($image));
        }
    }

    header('content-type:image/png');
    imagepng($image);
    imagedestroy($image);
}

// getVerify(3, 5, 100, 3);
