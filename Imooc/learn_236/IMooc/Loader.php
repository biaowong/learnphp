<?php
namespace IMooc;

class Loader
{
    public static function autoLoad($class)
    {
        require BASEDIR.'/'.str_replace('\\', '/', $class).'.php';
    }
}
