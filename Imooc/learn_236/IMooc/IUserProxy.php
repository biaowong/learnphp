<?php
namespace IMooc;
/**
 * 代理模式
 */

class IUserProxy
{
    public function getUserName($id);
    public function setUserName($id, $name);
}
