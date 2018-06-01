<?php
header('content-type:text/html;charset=utf-8');
// 获取微秒时间戳
echo microtime(),'<br/>';
// 获取当前时间戳
echo time(),'<br/>';
// 获取微妙时间戳，小数保留4位
echo microtime(true),'<br/>';
echo '<hr/>';

// 获取程序运行时间
$start = microtime(true);
for ($i=1; $i <= 10000; $i++) {
    $arr[] = $i;
}
$end = microtime(true);
echo '程序的运行时间为：', round($end-$start, 4), '<br/>';

// 得到当前日期时间信息
print_r(getdate());
echo '<hr/>';
// 等到当前日期时间
print_r(gettimeofday());
echo '<hr/>';
// 判断日期是否正确
var_dump(checkdate(1, 31, 2018));
