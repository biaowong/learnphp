<?php
header("content-type:text/html;charset=utf-8");
// phpinfo();
// 检查扩展是否开启
var_dump(extension_loaded('gd'));
// 检测函数是否可以使用
var_dump(function_exists('gd_info'));
// 得到GD库信息
var_dump(gd_info());
// 得到所有已定义的函数
print_r(get_defined_functions());
