<?php
require 'show.php';
// preg_replace, preg_filter
$pattern = '/[0-9]/';
$subject = 'weuyr3ui76as83s0ck9';
$replacement = '扯淡';

$str1 = preg_replace($pattern, $replacement, $subject);
$str2 = preg_filter($pattern, $replacement, $subject);

show($str1);
echo '<hr/>';
show($str2);

$pattern = array('/[0123]/', '/[456]/', '/[789]/');
$replacement = array('瞎', '扯', '谈');
$subject = array('weuy', 'r3ui', '76as83', 's', '0ck9');

$str1 = preg_replace($pattern, $replacement, $subject);
$str2 = preg_filter($pattern, $replacement, $subject);

echo '<hr/>';
show($str1);
echo '<hr/>';
show($str2);
