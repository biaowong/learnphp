<?php
header('Content-Type:text/html;charset=utf-8');
/**
 * 五种常见的 PHP 设计模式
 * https://www.cnblogs.com/leedaily/p/8250158.html
 */

/**
 * 策略模式
 */
abstract class BaseAgent // 抽象策略类
{
    abstract function printPage();
}

// 用很压抑客户端是IE时调用的类（环境角色）
class IeAgent extends BaseAgent
{
    function printPage()
    {
        return 'IE';
    }
}

// 用于客户端不是IE时调用的类（环境角色）
class OtherAgent extends BaseAgent
{
    function printPage()
    {
        return 'Not IE';
    }
}

// 具体策略角色
class Browser
{
    public function call($object)
    {
        return $object->printPage();
    }
}

$browser = new Browser();
echo $browser->call(new IeAgent());

/**
 * 广场模式
 */

interface People
{
    public function say();
}

class Man implements People
{
    public function say()
    {
        echo '我是男人<br>';
    }
}

class Women implements People
{
    public function say()
    {
        echo '我是女人<br>';
    }
}

class SimpleFactoty
{
    static function createMan()
    {
        return new Man();
    }

    static function createWomen()
    {
        return new Women();
    }
}

$man = SimpleFactoty::createMan();
$man->say();
$women = SimpleFactoty::createWomen();
$women->say();

/**
 * 单例模式
 */
class Single
{
    private $name;
    private function __construct(){}

    public static $instance;
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function setName($n)
    {
        $this->name = $n;
    }

    public function getName()
    {
        return $this->name;
    }
}

$oa = Single::getInstance();
$ob = Single::getInstance();
$oa->setName('Hello World!');
$ob->setName('Good Morning!');
echo $oa->getName();
echo $ob->getName();

/**
 * 注册模式
 */
class Register
{
    protected static $objects;

    public function set($alias, $object)
    {
        self::$objects[$alias] = $object;
    }

    static function get($name)
    {
        return self::$objects[$name];
    }

    public function _unset($alias)
    {
        unset(self::$objects[$alias]);
    }
}

/**
 * 适配器模式
 */
interface IDatabase
{
    function connect($host, $user, $passwd, $dbname);
    function query($sql);
    function close();
}

class MySQL implements IDatabase
{
    protected $conn;

    function connect($host, $user, $passwd, $dbname)
    {
        $conn = mysql_connect($host, $user, $passwd);
        mysql_select_db($dbname, $conn);
        $this->conn = $conn;
    }

    function query($sql)
    {
        $res = mysql_query($sql, $this->conn);
        return $res;
    }

    function close()
    {
        mysql_close($this->conn);
    }
}

class MySQLii implements IDatabase
{
    protected $conn;

    function connect($host, $user, $passwd, $dbname)
    {
        $conn = mysqli_connect($host, $user, $passwd);
        mysql_select_db($dbname, $conn);
        $this->conn = $conn;
    }

    function query($sql)
    {
        $res = mysqli_query($sql, $this->conn);
        return $res;
    }

    function close()
    {
        mysqli_close($this->conn);
    }
}

/**
 * 观察者模式
 */
abstract class EventGenerator
{
    private $observers = array();

    function addObserver(Observer $observer)
    {
        $this->observers[]=$observer;
    }

    function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update();
        }
    }
}

interface Observer
{
    function update();//这里就是在事件发生后要执行的逻辑
}

class Event extends EventGenerator
{
    function triger()
    {
        echo "Event<br>";
    }
}

class Observer1 implements Observer
{
    function update()
    {
        echo "逻辑1<br>";
    }
}

class Observer2 implements Observer
{
    function update()
    {
        echo "逻辑2<br>";
    }
}

$event = new Event();
$event->addObserver(new Observer1());
$event->addObserver(new Observer2());
$event->triger();
$event->notify();
