<?php
// 聚合关系（Aggregation）
class Clothes
{
    public $name = '工衣';
}

class Hat
{
    public $name = '工帽';
}

class Driver
{
    public $clothes;
    public $hat;

    public function wearClothes(Clothes $clothes)
    {
        $this->clothes = $clothes;
    }

    public function wearHat(Hat $hat)
    {
        $this->hat = $hat;
    }

    public function show()
    {
        return sprintf('公交车司机穿着%s和%s', $this->clothes->name, $this->hat->name);
    }
}

// 客户端代码
$driver = new Driver();
$driver->wearClothes(new Clothes());
$driver->wearHat(new Hat());
echo $driver->show();