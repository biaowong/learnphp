<?php
header('content-type:text/html;charset=utf-8');
echo 1+'3king';
echo '<br/>';
echo 1.2+'4abc';
echo '<br/>';
echo 3+'2e2';
echo '<br/>';
echo 2+'true';

$str = '';
$str = ' '; // 真
$str = '0';
$str = '0.0'; // 真
$str = 'false'; // 真
if ($str) {
    echo '我是真的';
}
else {
    echo '我是假的';
}

$res = 0;
$res = 0.0;
$res = null;
$res = array();
if ($res) {
    echo '我是真的';
}
else {
    echo '我是假的';
}
