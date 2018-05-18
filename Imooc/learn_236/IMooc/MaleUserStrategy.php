<?php
namespace IMooc;

use IMooc\UserStrategy;

class MaleUserStrategy implements UserStrategy
{
    public function showAd()
    {
        echo "2018 款男装";
    }

    public function showCategory()
    {
        echo "男装";
    }
}
