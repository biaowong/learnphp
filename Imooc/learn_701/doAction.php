<?php
header('content-type:text/html;charset:utf-8');
session_start();
echo "<pre>";
print_r($_POST);
echo "<hr />";
var_dump($_SESSION);


