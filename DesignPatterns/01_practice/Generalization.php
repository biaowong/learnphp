<?php
// 继承关系也称泛化关系（Generalization）
class Car
{
    public $name;
    public function run()
    {
        return '在行驶中';
    }
}

class Bus extends Car
{
    public function __construct()
    {
        $this->name = '公交车';
    }
}

class Taxi extends Car
{
    public function __construct()
    {
        $this->name = '出租车';
    }
}

// 客户端代码
$line2 = new Bus;
echo $line2->name . $line2->run();