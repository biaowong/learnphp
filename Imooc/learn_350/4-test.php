<?php
require 'show.php';
// preg_split
$pattern = '/[0-9]/';
$subject = '你3好2啊，5世界！';

$arr = preg_split($pattern, $subject);
show($arr);
