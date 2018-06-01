<?php
class Order
{
    // 订单状态
    private $state = 0;

    // 订单状态有变化时发送通知
    public function addOrder()
    {
        $this->state = 1;
        // 发送邮件
        Email::update($this->state);
        // 短信通知
        Message::update($this->state);
        // 记录日志
        Log::update($this->state);
        // 其他更多通知
    }
}

$order = new Order();
$order->addOrder();
