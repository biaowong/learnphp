<?php
/**
 * 适配器接口，所有的支付适配器都需实现这个接口。
 * 不管第三方支付实现方式如何，对于客户端来说，都
 * 用pay()方法完成支付
 */
interface PayAdapter
{
    public function pay();
}

/**
 * 支付宝支付类
 */
class Alipay
{
    public function sendPayment()
    {
        echo "使用支付宝支付。";
    }
}

/**
 * 支付宝适配器
 */
class AlipayAdapter implements PayAdapter
{
    public function pay()
    {
        // 实例化Alipay类，并用Alipay的方法实现支付
        $alipay = new Alipay();
        $alipay->sendPayment();
    }
}

// 客户端代码
$alipay = new AlipayAdapter();
// 用pay()方法实现支付
$alipay->pay();

/**
 * 微信支付类
 */
class WechatPay
{
    public function scan()
    {
        echo "扫描二维码后，";
    }

    public function doPay()
    {
        echo "使用微信支付";
    }
}

/**
 * 微信支付适配器
 */
class WechatPayAdapter implements PayAdapter
{
    public function pay()
    {
        // 实例化WechatPay类，并用WechatPay的方法实现支付。
        // 注意，微信支付的方式和支付宝的支付方式不一样但是
        // 适配之后，他们都能用pay()来实现支付功能
        $wechatPay = new WechatPay();
        $wechatPay->scan();
        $wechatPay->doPay();
    }
}

// 客户端代码
$wechat = new WechatPayAdapter();
// 也是用pay()方法实现支付
$wechat->pay();
