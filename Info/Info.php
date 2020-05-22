<?php

namespace fall1600\Package\Suntech\Info;

use fall1600\Package\Suntech\Contracts\OrderInterface;
use fall1600\Package\Suntech\Contracts\PayerInterface;

abstract class Info
{
    /**
     * @var string
     */
    protected $merchantId;

    /**
     * @var OrderInterface
     */
    protected $order;

    /**
     * @var PayerInterface
     */
    protected $payer;

    /** @return array */
    public abstract function getInfo();

    public function __construct(string $merchantId, OrderInterface $order, PayerInterface $payer)
    {
        $this->merchantId = $merchantId;

        $this->order = $order;

        $this->payer = $payer;
    }
}
