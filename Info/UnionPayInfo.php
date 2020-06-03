<?php

namespace fall1600\Package\Suntech\Info;

use fall1600\Package\Suntech\Contracts\OrderInterface;
use fall1600\Package\Suntech\Contracts\PayerInterface;

class UnionPayInfo extends Info
{
    public function __construct(string $merchantId, OrderInterface $order, PayerInterface $payer)
    {
        parent::__construct($merchantId, $order, $payer);
    }

    public function getInfo()
    {
        return parent::getInfo() +
            [
                'Card_Type' => 1,
            ];
    }
}
