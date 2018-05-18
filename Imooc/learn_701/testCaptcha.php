<?php
require_once 'extends/Captcha.class.php';
$config = array(
    'snow' => 20
);
$captcha = new Captcha($config);
session_start();
$_SESSION['verifyCode'] = $captcha->getCaptcha();
