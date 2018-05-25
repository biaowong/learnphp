<?php
require 'show.php';
// preg_match, preg_match_all
$pattern = '/[0-9]/';
$subject = 'weuyr3ui76as83s0ck9';

$m1 = $m2 = array();
$t1 = preg_match($pattern, $subject, $m1);
$t2 = preg_match_all($pattern, $subject, $m2);

show($m1);
echo '<hr/>';
show($m2);
echo '<hr/>';
show($t1.'||'.$t2);
