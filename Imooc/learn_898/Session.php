<?php
header("content-type:text/html;charset=utf-8");
// Session启动
session_start();
// 设置session
$_SESSION['username'] = 'king';
$_SESSION['email'] = 'muke@imooc.com';
$_SESSION['age'] = 23;

echo 'SESSION的名字：', session_name().'<br/>';
echo 'SESSION的ID：', session_id().'<br/>';
