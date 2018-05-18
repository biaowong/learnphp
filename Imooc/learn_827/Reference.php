<?php
namespace IMooc\learn_827;

// 值传递
function factorial($num) {

    $result = 1;
    for ($i=1; $i <= $num; $i++) {
        $result *= $i;
    }

$num = 12;

    return $result;
}

$num = 4;
echo 'factorial: ', factorial($num), '  $num: ', $num;


// 引用传递
function swap(&$a , &$b)
{
    $tmp = $a;
    $a = $b;
    $b = $tmp;
}

$a = 3;
$b = 5;
swap($a, $b);
echo '    $a: ', $a, '  $b: ',$b;
