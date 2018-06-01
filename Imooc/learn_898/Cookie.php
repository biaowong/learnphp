<?php
// 设置Cookie的过期时间
setcookie('a', 'aaa', time()+10);
setcookie('b', 'bbb', time()+20);
setcookie('c', 'ccc', time()+30);
setcookie('d', 'ddd', time()+40);
// 一周内自动登录
setcookie('auth', true, time()+7*24*60*60);
setcookie('authLogin', true, strtotime('+7 days'));
// 测试作用域
setcookie('testPath1', true, time()+3600); // 默认当前路径下
setcookie('testPath2', true, time()+3600, '/'); // 根目录
setcookie('testPath3', true, time()+3600, '/imooc/learn_898/a'); // 设置指定路径
// 测试是否只使用HTTPS方式访问Cookie
setcookie('secure_test1', 'secure_test_https1', time()+3600, '/', '', true);
setcookie('secure_test2', 'secure_test_https2', time()+3600, '/', '', false);


