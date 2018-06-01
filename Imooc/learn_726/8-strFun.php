<?php
header('content-type:text/html;charset=utf-8');
$str = 'hello king';
var_dump(is_string($str));
echo "<br/>";
echo '字符串长度为：'.strlen($str);
echo "<br/>";
$username = 'KiNg a test';
echo strtolower($username);
echo "<br/>";
echo strtoupper($username);
echo "<br/>";
echo ucfirst($username);
echo "<br/>";
echo ucwords($username);
