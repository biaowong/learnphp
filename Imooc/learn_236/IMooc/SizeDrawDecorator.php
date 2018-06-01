<?php
namespace IMooc;

use IMooc\DrawDecorator;

class SizeDrawDecorator implements DrawDecorator
{
    protected $size = '';

    public function __construct($size='14px')
    {
        $this->size = $size;
    }

    public function beforeDraw()
    {
        echo "<div style='font-szie: {$this->size};'>";
    }

    public function afterDraw()
    {
        echo "</div";
    }
}
