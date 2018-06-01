<?php
header('content-type:text/html;charset=utf-8');
$char = 'k';
echo ord($char);
echo '<br/>';
echo chr(107);
echo '<hr/>';
$string = 'abcdef';
echo substr($string, 2,2);
echo '<br/>';
echo substr($string, 3);
echo '<br/>';
echo substr($string, -2);
echo '<br/>';
echo substr($string, -4, 2);
echo '<br/>';
echo substr($string, 0, -3);
echo '<br/>';
echo substr($string, -4, -1);
echo '<hr/>';
// 比较字符串的大小
$str1 = 'a';
$str2 = 'b';
echo strcmp($str1, $str2);
echo '<hr/>';
// 字符串查找
$email = '382771946@qq.com';
echo strpos($email, '@');
echo '<br/>';
$str = 'abcdef';
echo strpos($str, 'b');
echo '<hr/>';

// 过滤字符串中的 HTML
$str = "<h1>this is a test</h1><a href='http://www.baidu.com'>baidu</a>";
echo strip_tags($str, '<a>');
