<?php
namespace IMooc;
/**
 * 代理模式
 */

class Proxy implements \IMooc\IUserProxy
{
    public function getUserName($id)
    {
        $db = \IMooc\Factory::getDatabase('slave');
        $db->query("SELECT name FROM user WHERE id = $id limit 1");
    }

    public function setUserName($id, $name)
    {
        $db = \IMooc\Factory::getDatabase('master');
        $db->query("UPDATE user SET name = $name WHERE id = $id");
    }
}

$proxy = new \IMooc\Proxy();
$proxy->getUserName($id);
$proxy->setUserName($id, 'TEST');
