<?php

namespace fall1600\Package\Suntech\Tests;

use fall1600\Package\Suntech\Contracts\OrderInterface;
use fall1600\Package\Suntech\Contracts\PayerInterface;
use fall1600\Package\Suntech\Info\BasicInfo;
use fall1600\Package\Suntech\Merchant\CreditMerchant;
use fall1600\Package\Suntech\Suntech;
use PHPUnit\Framework\TestCase;

class SuntechTest extends TestCase
{
    /** @group gg */
    public function test_checkout()
    {
        //arrange

        $merchantId = 'S2005269069';

        $order = $this->getMockBuilder(OrderInterface::class)
            ->getMock();

        $order->expects($this->atLeastOnce())
            ->method('getAmount')
            ->willReturn(1000);

        $payer = $this->getMockBuilder(PayerInterface::class)
            ->getMock();

        $payer->expects($this->atLeastOnce())
            ->method('getName')
            ->willReturn('foobar');

        $payer->expects($this->atLeastOnce())
            ->method('getTelephone')
            ->willReturn('0988777888');

        $suntech = new Suntech();

        $info = new BasicInfo($merchantId, $order, $payer);

        //act
        $suntech->setIsProduction(false)
            ->setMerchant(new CreditMerchant($merchantId, '791c2eb077158a82577c'))
            ->checkout($info);

        //assert
    }

    public function test_query()
    {
        //arrange

        $suntech = new Suntech();

        $order = $this->getMockBuilder(OrderInterface::class)
            ->getMock();

        $order->expects($this->atLeastOnce())
            ->method('getAmount')
            ->willReturn(1000);

        //act
        $result = $suntech
            ->setIsProduction(false)
            ->setMerchant(new CreditMerchant('S2005269069', '791c2eb077158a82577c'))
            ->query($order, 'S0N0092005260000458');

        //assert
        var_dump($result);
    }
}
