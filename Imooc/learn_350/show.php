<?php
/**
 * 输出打印变量
 * @param  mixed $var 被输出打印的变量
 */
function show($var=null)
{
    if (empty($var)) {
        echo 'null';
    }
    elseif (is_array($var) || is_object($var)) {
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }
    else {
        echo $var;
    }
}
