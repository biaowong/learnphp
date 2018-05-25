<?php
require 'show.php';

$pattern = '/imooc.+123/U';
$pattern = '/imooc.+123/i';
$pattern = '/imooc.+123/x';
$pattern = '/imooc.+123/s';
$pattern = '/imooc.+123/';
$subject = 'I Love imooc__123123123123123123';

$matches = array();
preg_match($pattern, $subject, $matches);

show($matches);
