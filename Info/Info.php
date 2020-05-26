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

    public function __construct(string $merchantId, OrderInterface $order, PayerInterface $payer)
    {
        $this->merchantId = $merchantId;

        $this->order = $order;

        $this->payer = $payer;
    }

    public function getInfo()
    {
        return [
            'web' => $this->merchantId,
            'MN' => $this->order->getAmount(),
            'sna' => $this->payer->getName(),
            'sdt' => $this->payer->getTelephone(),
        ];
    }

    /**
     * @return OrderInterface
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return PayerInterface
     */
    public function getPayer()
    {
        return $this->payer;
    }

    /**
     * @return string
     */
    public function getMerchantId()
    {
        return $this->merchantId;
    }
}
