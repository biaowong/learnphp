<?php
namespace App\Decorator;

class Template
{
    protected $controller;

    public function beforeRequest($controller)
    {
        $this->controller = $controller;
    }

    public function afterRequest($return_value)
    {
        foreach ($return_value as $k => $v) {
            $this->controller->assign($k, $v);
        }

        $this->controller->display();
    }
}
