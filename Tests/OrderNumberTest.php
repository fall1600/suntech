<?php

namespace fall1600\Package\Suntech\Tests;

use fall1600\Package\Suntech\Contracts\OrderInterface;
use fall1600\Package\Suntech\Contracts\PayerInterface;
use fall1600\Package\Suntech\Info\BasicInfo;
use fall1600\Package\Suntech\Info\Decorator\OrderNumber;
use PHPUnit\Framework\TestCase;

class OrderNumberTest extends TestCase
{
    public function provider()
    {
        return [
            ['order.number.555'],
            ['111112222233333444445'],
        ];
    }

    /**
     * @dataProvider provider
     */
    public function test_getInfo_with_exception($orderNumber)
    {
        //arrange
        $this->expectException(\LogicException::class);

        $merchantId = 'merchant.id.123';

        $order = $this->getMockBuilder(OrderInterface::class)
            ->getMock();

        $payer = $this->getMockBuilder(PayerInterface::class)
            ->getMock();

        $info = new BasicInfo($merchantId, $order, $payer);
        $info = new OrderNumber($info, $orderNumber);

        //act
        $info->getInfo();

        //assert
    }
}
