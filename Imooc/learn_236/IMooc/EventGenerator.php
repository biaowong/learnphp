<?php
namespace IMooc;

abstract class EventGenerator
{
    private $observer = array();

    function addOBserver(\IMooc\Observer $observer) {
        $this->observer[] = $observer;
    }

    function notify() {
        foreach ($this->observer as $observer) {
            $observer->update();
        }
    }
}
