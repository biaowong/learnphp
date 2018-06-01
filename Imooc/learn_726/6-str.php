<?php
header('content-type:text/html;charset=utf-8');
// 强制转换
$var = 123;
$var = 23.3;
$var = true;
$var = false;
$var = null;
$var = array(1, 2, 3);
$var = new stdClass;
$var = fopen('1-str.php', 'r');
// $res = (string)$var;
$res = strval($var);
var_dump($res);

// 永久转换
echo '<hr/>';
$str = 'king';
$str = 123;
echo gettype($str);
echo '<br/>';
settype($str, 'string');
var_dump($str);
