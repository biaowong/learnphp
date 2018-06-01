<?php

interface Vehicle
{
    public function run();
}

class Car implements Vehicle
{
    public $name = '汽车';
    public function run()
    {
        return $this->name . '在路上行驶';
    }
}

class Ship implements Vehicle
{
    public $name = '轮船';
    public function run()
    {
        return $this->name . '在海上航行';
    }
}

// 客户端代码
$car = new Car;
echo $car->run();
