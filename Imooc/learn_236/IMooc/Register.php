<?php
namespace IMooc;

class Register
{
    protected static $objects;

    public function set($alias, $object)
    {
        self::$objects[$alias] = $object;
    }

    public function get($alias)
    {
        return self::$objects[$alias];
    }

    public function unset($alias)
    {
        unset(self::$objects[$alias]);
    }
}
