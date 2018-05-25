<?php
require_once 'RegexTool.php';
require_once 'show.php';

$regex = new RegexTool();
$regex->setFixMode('U');
$r = $regex->isEmail('assdfsaf@qq.com');
show($r);
