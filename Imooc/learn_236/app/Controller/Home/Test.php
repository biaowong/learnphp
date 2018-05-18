<?php
namespace app\Controller\Home;

class Test
{
    public static function test()
    {
        echo __METHOD__;
    }

    public function output()
    {
        file_put_contents("php://output", "message sent by output" . PHP_EOL);
        file_put_contents("php://stdout", "message sent by stdout" . PHP_EOL);
        print("message sent by print" . PHP_EOL);

        echo "SAPI:" , PHP_SAPI , PHP_EOL;
    }
}
