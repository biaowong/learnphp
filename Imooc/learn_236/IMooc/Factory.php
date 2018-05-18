<?php
namespace IMooc;

class Factory
{
    public static function create($class)
    {
        return new $class();
    }

    public static function getDatabase($id='master')
    {
        $key = 'database_'.$id;
        if ($id == 'slave') {

            $slaves = Application::getInstance()->config['database']['slave'];
            $db_conf = $slaves[array_rand($slaves)];
        }
        else {

            $db_conf = Application::getInstance()->config['database'][$id];
        }

        $db = Register::get($key);
        if (!$db) {

            $db = new Database\MySQLi();
            $db->connect($db_conf['host'], $db_conf['user'], $db_conf['password', $db_conf['dbname']]);
            Register::set($key, $db);
        }

        return $db;
    }
}
