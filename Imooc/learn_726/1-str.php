<?php
header('content-type:text/html;charset=utf-8');

echo 'king';
echo '<br />';
echo "this is king show time<br />";
echo '<hr />';
$username = 'king';
$age = 12;
$email = '382771946@qq.com';
echo $username;
echo '<br />';
echo $email;
echo '<hr />';
echo "$username";
echo '<br />';
echo '$username';
/**
 * 双引号和单引号的区别：
 * - 双引号是解析变量的
 * - 单引号不解析变量
 */
echo '<hr />';
$str = 'this is a test';
echo $str;
echo '<br />';
$str = 'this is a test of king\'s PHP He Said "i\'m Fine"';
echo $str;
echo '<hr />';
$str = "He Said \"I'm Fine\" Thank You!";
echo $str;
echo '<hr />';
// 双引号解析所有的转译符
$str = "1\n2\r3\t4\$5\\678";
echo $str;
echo '<hr />';
// 单引号只解析\',\\
$str = '1\n2\r3\t4\$5\\6\'78';
echo $str;
