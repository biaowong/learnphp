<?php
// 依赖关系（Dependence）
class Oil
{
    public $type = '汽油';
    public function add()
    {
        return $this->type;
    }
}

class Car
{
    public function beforeRun(Oil $oil)
    {
        return '添加' . $oil->add();
    }
}

// 客户端代码
$car = new Car;
echo $car->beforeRun(new Oil());