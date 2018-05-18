<?php
define('BASEDIR', __DIR__);

include BASEDIR.'/IMooc/Loader.php';
spl_autoload_register('\\IMooc\\Loader::autoLoad');

$config = new \IMooc\Config(__DIR__.'/configs');
var_dump($config['Controller']);
