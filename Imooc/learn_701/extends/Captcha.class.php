<?php
define("FONT_FILE", dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'fonts'.DIRECTORY_SEPARATOR.'hwkaiti.ttf');

class Captcha
{
    // 字体大小
    private $_size = 20;
    // 画布宽度
    private $_width = 120;
    // 画布高度
    private $_height = 40;
    private $_length = 4;
    private $_fontfile = FONT_FILE;
    private $_snow = 0;
    private $_pixel = 0;
    private $_line = 0;
    private $_image = null;

    public function __construct($config=array())
    {
        $this->_checkConfig($config);
        $this->_image = imagecreatetruecolor($this->_width, $this->_height);
    }

    /**
     * 校验初始化配置参数
     * @param  array $config 配置参数
     * @return void
     */
    private function _checkConfig($config)
    {
        $keys = array('size', 'width', 'height', 'length', 'fontfile', 'snow', 'pixel', 'line');
        foreach ($keys as $key) {
            if (isset($config[$key]) && $config[$key]>0) {
                $_key = '_'.$key;
                $this->$_key = (int)$config[$key];
            }
        }
    }

    /**
     * 获取验证码图片
     * @return [type] [description]
     */
    public function getCaptcha()
    {
        $white = imagecolorallocate($this->_image, 255, 255, 255);
        // 填充矩形
        imagefilledrectangle($this->_image, 0, 0, $this->_width, $this->_height, $white);
        // 生成验证码
        $str = $this->_generateStr($this->_length);
        if (false === $str) {
            return false;
        }
        $fontfile = $this->_fontfile;

        // 绘制验证码
        for ($i=0; $i < $this->_length; $i++) {

            $size = $this->_size;
            $angle = mt_rand(-30, 30);
            $x = ceil($this->_width/$this->_length) * $i + mt_rand(5, 10);
            $y = ceil($this->_height/1.5);
            $color = $this->_getRandColor();
            $text = $str{$i};
            imagettftext($this->_image, $size, $angle, $x, $y, $color, $fontfile, $text);
        }

        //* -- 像素和线段
        if ($this->_snow) {
            $this->_getSnow();
        }
        else {
            if ($this->_pixel) {
                $this->_getPixel();
            }
            if ($this->_line) {
                $this->_getLine();
            }
        }

        // 输出图像
        header('content-type:image/png');
        imagepng($this->_image);
        return strtolower($str);
    }

    /**
     * 绘制雪花
     * @return [type] [description]
     */
    private function _getSnow()
    {
        for ($i=1; $i < $this->_snow; $i++) {
            imagestring($this->_image, mt_rand(1, 5), mt_rand(0, $this->_width), mt_rand(0, $this->_height), '*', $this->_getRandColor());
        }
    }

    /**
     * 绘制像素
     * @return [type] [description]
     */
    private function _getPixel()
    {
        for ($i=1; $i < $this->_pixel; $i++) {
            imagesetpixel($this->_image, mt_rand(0, $this->_width), mt_rand(0, $this->_height), $this->_getRandColor());
        }
    }

    /**
     * 绘制线段
     * @return [type] [description]
     */
    private function _getLine()
    {
        for ($i=1; $i < $this->_line; $i++) {
            imageline($this->_image, mt_rand(0, $this->_width), mt_rand(0, $this->_height), mt_rand(0, $this->_width), mt_rand(0, $this->_height), $this->_getRandColor());
        }
    }

    /**
     * 产生验证码字符
     * @param  integer $length 验证码长度
     * @return stirng          随机字符
     */
    private function _generateStr($length=4)
    {
        if ($length<1 || $length>30) {
            return false;
        }
        $chars = array(
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'k', 'm', 'n', 'p', 'x', 'y', 'z',
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'K', 'M', 'N', 'P', 'X', 'Y', 'Z',
            1, 2, 3, 4, 5, 6, 7, 8, 9
        );
        $str = join('', array_rand(array_flip($chars), $length));

        return $str;
    }

    /**
     * 获取随机颜色
     * @return [type] [description]
     */
    private function _getRandColor()
    {
        return imagecolorallocate($this->_image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
    }
}
