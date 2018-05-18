<?php
namespace IMooc;

use IMooc\UserStrategy;

class FemaleUserStrategy implements UserStrategy
{
    public function showAd()
    {
        echo "2018 新款女装";
    }

    public function showCategory()
    {
        echo "女装";
    }
}
