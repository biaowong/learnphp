<?php
namespace IMooc\learn_827;

/**
 * 递归函数
 * @param  [int] $i 求$i的阶级
 * @return [int]    [description]
 */
function recursive($i)
{
    $sum = 1;
    echo "recursive()当前参数\$i值为：{$i}\n";

    if (1 == $i) {
        echo "\$i={$i};\$sum={$sum}\n";
        return 1;
    }
    else {
        $sum = $i * recursive($i-1);
    }
    echo "\$i={$i};\$sum={$sum}\n";
    return $sum;
}

recursive(3);


/**
 * 闭包函数
 */
$message = "Hello World!";
$example = function($name) use(&$message) {
    echo "{$message}, {$name}.\n";
};
$message = "Hello!";
$name = "Lily";
$example($name);

function test_closure($name, \Closure $closure) {

    echo "Hello, {$name}.\n";
    $closure();
}

test_closure($name, function() {
    echo "Redirect to VIP Welcome page.";
});
