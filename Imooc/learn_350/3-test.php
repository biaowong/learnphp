<?php
require 'show.php';
// preg_grep
$pattern = '/[0-9]/';
$subject = array('weuy', 'r3ui', '76as83', 's', '0ck9');

$arr = preg_grep($pattern, $subject);

show($arr);
