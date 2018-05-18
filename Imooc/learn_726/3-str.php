<?php
header('content-type:text/html;charset=utf-8');
// 字符串修改
$str = 'abcdef';
echo $str{0};
echo '<br/>';
$char = $str{3};
echo $char;
echo '<br/>';
$str{1} = 'm';
echo $str;
echo '<br/>';
$str{4} = 'hello';
echo $str;
echo '<hr/>';

// 字符串删除
$str{1} = '';
echo $str;
var_dump($str);
echo '<hr/>';

// 更新操作
$str = 'abc';
$str{3} = 'dsdfds';
echo $str;
echo '<br/>';
$str{6} = 'c';
echo $str;
var_dump($str);
echo '<br/>';
$string = 'abcdefghigklmnopqrstuvwxyz';
echo $string{mt_rand(0, strlen($string)-1)};
