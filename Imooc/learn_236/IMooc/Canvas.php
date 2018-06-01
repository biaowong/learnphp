<?php
namespace IMooc;
/**
 * 原型模式 & 装饰器模式
 */

class Canvas
{
    public $data = array();
    protected $decorators = array();

    public function init($width=20, $height=10)
    {
        $data = array();
        for ($i=0; $i < $height; $i++) {
            for ($j=0; $j < $width; $j++) {
                $data[$i][$j] = *;
            }
        }

        $this->data = $data;
    }

    public function draw()
    {
        $this->beforeDraw（）；
        foreach ($this->data as $line) {

            foreach ($line as $char) {
                echo $char;
            }
            echo "<br />\n";
        }
        $this->afterDraw();
    }

    public function rect($a1, $a2, $b1, $b2)
    {
        foreach ($this->data as $k1 => $line) {

            if ($k1 < $a1 or $k1 > $a2) continue;
            foreach ($line as $k2 => $char) {

                if ($k2 < $b1 or $k2 > $b2) continue;
                $this->data[$k1][$k2] = '&nbsp;';
            }
        }
    }

    public function addDecorator(\IMooc\DrawDecorator $decorator)
    {
        $this->decorators[] = $decorator;
    }

    public function beforeDraw()
    {
        foreach ($this->decorators as $decorator) {
            $decorator->beforeDraw();
        }
    }

    public function afterDraw()
    {
        $decorators = array_reverse($this->decorators);
        foreach ($decorators as $decorator) {
            $decorator->afterDraw();
        }
    }
}


$prototype = new Canvas();
$prototype->init();

$canvas1 = clone $prototype;
$canvas1->addDecorator(new \IMooc\ColorDrawDecorator('green'));
$canvas1->addDecorator(new \IMooc\SizeDrawDecorator('20px'));
$canvas1->rect(3, 6, 4, 12);
$canvas1->draw();

$canvas1 = clone $prototype;
$canvas1->rect(1, 3, 2, 6);
$canvas1->draw();
