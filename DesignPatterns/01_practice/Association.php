<?php
// 关联关系（Association）
class Driver
{
    public $cars = array();
    public function addCar(Car $car)
    {
        $this->cars[] = $car;
    }
}

class Car
{
    public $drivers = array();
    public function addDriver(Driver $driver)
    {
        $this->drivers[] = $driver;
    }
}

// 客户端代码
$jack = new Driver();
$line1 = new Car();
$jack->addCar($line1);
$line1->addDriver($jack);
print_r($jack);