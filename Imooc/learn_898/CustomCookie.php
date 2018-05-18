<?php
/**
 * Cookie的设置、读取、删除
 */

class CustomCookie {

    private static $_instance = null;
    private $expire = 0;
    private $path = '';
    private $domain = '';
    private $secure = false;
    private $httponly = false;

    private function __construct(array $options=[])
    {
        $this->setOptions($options);
    }

    /**
     * 设置相关选项
     * @param array $options Cookie相关选项
     */
    private function setOptions(array $options=[])
    {
        if (isset($options['expire'])) {
            $this->expire = (int)$options['expire'];
        }

        if (isset($options['path'])) {
            $this->expire = $options['path'];
        }

        if (isset($options['domain'])) {
            $this->expire = $options['domain'];
        }

        if (isset($options['secure'])) {
            $this->expire = (bool)$options['secure'];
        }

        if (isset($options['httponly'])) {
            $this->expire = (bool)$options['httponly'];
        }
    }

    /**
     * 单例模式
     * @param  array  $options Cookie相关选项
     * @return object          对象实例
     */
    public static function getInstance(array $options=[])
    {
        if (is_null(self::$_instance)) {
            $class = __CLASS__;
            self::$_instance = new $class($options);
        }

        return self::$_instance;
    }

    /**
     * 设置Cookie
     * @param string $name    Cookie的名称
     * @param mixed  $value   Cookie的值
     * @param array  $options Cookie相关选项
     */
    public function set(string $name, $value, array $options=[])
    {
        if (is_array($options) && count($options)>0) {
            $this->setOptions($options);
        }
        if (is_array($value) || is_object($value)) {
            $value = json_encode($value, JSON_FORCE_OBJECT);
        }

        setcookie($name, $value, $this->expire, $this->path, $this->domain, $this->secure, $this->httponly);
    }

    /**
     * 得到指定Cookie
     * @param  string $name Cookie名称
     * @return mixed        返回null或者对象或者标量
     */
    public function get(string $name)
    {
        if (isset($_COOKIE[$name])) {
            return substr($_COOKIE[$name], 0, 1) == '{' ? json_decode($_COOKIE[$name]) : $_COOKIE[$name];
        }
        else {
            return null;
        }
    }

    /**
     * 删除指定Cookie
     * @param  string $name    Cookie名称
     * @param  array  $options 数组选项
     */
    public function delete(string $name, array $options=[])
    {
        if (is_array($options) && count($options)>0) {
            $this->setOptions($options);
        }
        if (isset($_COOKIE[$name])) {
            setcookie($name, '', time()-1, $this->path, $this->domain, $this->secure, $this->httponly);
        }
    }

    public function deleteAll(array $options=[])
    {
        if (is_array($options) && count($options)>0) {
            $this->setOptions($options);
        }
        if (!empty($_COOKIE)) {
            foreach ($_COOKIE as $name => $value) {
                setcookie($name, '', time()-1, $this->path, $this->domain, $this->secure, $this->httponly);
                unset($_COOKIE[$name]);
            }
        }
    }
}

$customCookie = CustomCookie::getInstance();
// var_dump($customCookie);
// $customCookie->set('aa', 111);
// $customCookie->set('bb', 222);
// $customCookie->set('username', 'king', ['expire'=>time()+3600]);
// $customCookie->set('userinfo', ['username'=>'king', 'age'=>23]);
// var_dump($customCookie->get('userinfo'));
// $customCookie->delete('aa');
$customCookie->deleteAll();
